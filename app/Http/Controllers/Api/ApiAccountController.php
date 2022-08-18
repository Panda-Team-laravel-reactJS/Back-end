<?php

namespace App\Http\Controllers\Api;

use App\Core\Mail;
use Exception;
use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Customer;
use App\Models\OTP;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ApiAccountController extends Controller
{
    public function register(Request $request)
    {
        $validatorFirst = Validator::make($request->all(), [
            "name" => "required|string",
            "email" => "required|email|unique:customers",
            "phoneNumber" => "required|numeric|digits:10",
            "address" => "required",
            "gender" => "required|in:Male,Female,Others"
        ], [
            "name.required" => "Tên tài khoản không được để trống!",
            "name.string" => "Tên phải là ký tự ",
            "email.required" => "Email không được để trống!",
            "email.email" => "Email phải nhập đúng định dạng!",
            "email.unique" => "Email đã tồn tại!",
            "phoneNumber.required" => "Số điện thoại không được để trống",
            "phoneNumber.numeric" => "Số điện thoại không được chứa ký tự",
            "address.required" => "Địa chỉ không được để trống!",
            "gender.required" => "Giới tính không được để trống!",
            "gender.in" => "Giói tính phải là: Male(Nam), Female(Nữ) hoặc là Others(Giới tính khác)",
        ]);

        if ($validatorFirst->fails()) {
            return ["errors" => $validatorFirst->errors(), "status" => false];
        }
        if (!$request->isSentOnce) {
            $otp = OTP::find($request->email);
            if (empty($otp)) {
                $otp = new OTP();
                $otp->email = $request->email;
            } 
            $otp->OTP = rand(100000, 999999);
            $otp->OTP_expired = date_create()->modify("+5 minutes");
            $otp->save();

            Mail::sendOTP($request->email, $request->name, $otp->OTP);
            return ["errors" => null, "status" => true];
        }

        $validatorSecond = Validator::make($request->all(), [
            "otp" => "required",
            "username" => "required",
            "password" => "required|min:8",
        ], [
            "otp.required" => "Không được để trống OTP!",
            "username.required" => "Tên đăng nhập không được để trống!",
            "password.required" => "Mật khẩu không được để trống!",
            "password.min" => "Mật khẩu phải nhiều hơn 8 ký tự"
        ]);
        if ($validatorSecond->fails()) {
            return ["errors" => $validatorSecond->errors(), "status" => false];
        }
        //check if is exact OTP?
        $otp = OTP::find($request->email);
        if ($otp->OTP != $request->otp) {
            return ["status" => false, "errors" => ["otp" => "Mã OTP không đúng. Vui lòng thử lại!"]];
        }

        DB::beginTransaction();
        try {
            if (ctype_digit($request->username)) {
                throw new Exception("Username is not a number");
            }
            $customer = new Customer();
            $customer->name = $request->name;
            $customer->email = $request->email;
            $customer->phone_number = $request->phoneNumber;
            $customer->address = $request->address;
            $customer->gender = $request->gender;
            $customer->save();

            $account = new Account();
            $account->customer_id = $customer->id;
            $account->username = $request->username;
            $account->password = Hash::make($request->password);
            $account->save();

            $otp = OTP::find($request->email);
            $otp->OTP = null;
            $otp->save();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return ["status" => false, "errors" => ["password" => $e->getMessage()]];
        }
        
        return ["status" => true, "errors" => null];
    }

    public function login(Request $request)
    {
        $validatorFirst = Validator::make($request->all(), [
            "username" => "required",
            "password" => "required|min:8",
        ], [
            "username.required" => "Tên đăng nhập không được để trống!",
            "password.required" => "Mật khẩu không được để trống!",
            "password.min" => "Mật khẩu phải nhiều hơn 8 ký tự",

        ]);
        if ($validatorFirst->fails()) {
            return ["errors" => $validatorFirst->errors(), "status" => false];
        }
        $account = Account::where("username", $request->username)->first();
        if ($account != null) {
            if (Hash::check($request->password, $account->password)) {
                $account->access_token = Str::random(50);
                $account->save();
                return ["status" => true, "errors" => null, "userData" => ["userName" => $request->username, "name" => $account->customerInfo->name, "accessToken" => $account->access_token]];
            };
            return ["status" => false, "errors" => ["password" => "Sai mật khẩu!"]];
        }
        return ["status" => false, "errors" => ["username" => "Tài khoản không tồn tại!"]];
    }
    public function resetPassword (Request $request) {
        $validatorFirst = Validator::make($request->all(), [
            "email" => "required|email|exists:App\Models\Customer,email"
        ], [
            "email.required" => "Email không được để trống!",
            "email.email" => "Email chưa đúng hình thức! (@...)",
            "email.exists" => "Email chưa được đăng kí!"
        ]);
        if ($validatorFirst->fails()) {
            return ["status" => false, "errors" => $validatorFirst->errors()];
        }
        if (!$request->isSentOnce) {
            $otp = OTP::find($request->email);
            $otp->OTP = rand(100000, 999999);
            $otp->OTP_expired = date_create()->modify("+5 minutes");
            $otp->save();

            Mail::sendOTP($request->email, $request->name, $otp->OTP);
            return ["errors" => null, "status" => true];
        }

        $validatorSecond = Validator::make($request->all(), [
            "otp" => "required",
            "password" => "required|min:8"
        ], [
            "otp.required" => "Mã OTP không được để trống!",
            "password.required" => "Mật khẩu không được để trống!",
            "password.min" => "Mật khẩu phải nhiều hơn 8 ký tự",
        ]);
        if ($validatorSecond->fails()) {
            return ["status" => false, "errors" => $validatorSecond->errors()];
        }
        $otp = OTP::find($request->email);
        if ($otp->OTP != $request->otp) {
            return ["status" => false, "errors" => ["otp" => "Mã OTP không chính xác!"]];
        }
        $account = Customer::where("email", $request->email)->first()->account;
        $account->password = Hash::make($request->password);
        $account->save();

        $otp->OTP = null;
        $otp->save();

        return ["status" => true, "errors" => null];
    }
}
