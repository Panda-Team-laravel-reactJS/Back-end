<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Customer;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ApiAccountController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "username" => "required",
            "password" => "required|min:8",
            "name" => "required|string",
            "email" => "required|email",
            "phone_number" => "required|numeric|digits:10",
            "address" => "required",
            "gender" => "required|in:Male,Female,Others",
            "dob" => "required|date"

        ], [
            "username.required" => "Tên đăng nhập không được để trống!",
            "password.required" => "Mật khẩu không được để trống!",
            "password.min" => "Mật khẩu phải nhiều hơn 8 ký tự",
            "name.required" => "Tên tài khoản không được để trống!",
            "name.string" => "Tên phải là ký tự ",
            "email.required" => "Email không được để trống!",
            "email.email" => "Email phải nhập đúng định dạng",
            "phone_number.required" => "Số điện thoại không được để trống",
            "phone_number.numeric" => "Số điện thoại không được chứa ký tự",
            "address.required" => "Địa chỉ không được để trống!",
            "gender.required" => "Giới tính không được để trống!",
            "gender.in" => "Giói tính phải là: Male(Nam), Female(Nữ) hoặc là Others(Giới tính khác)",
            "dob.required" => "Ngày, tháng, năm sinh không được để trống!",
            "dob.date" => "Nhập đúng định dạng: yyyy-mm-dd"
        ]);
        
        if ($validator->fails()) {
            return ["error" => $validator->errors(), "status" => "fail"];
        }
        //save account

        //save customer
    
            DB::beginTransaction();
            try {
                if (ctype_digit($request->username)) {
                    throw new Exception("username is not a number");
                }
                $customer = new Customer();
                $customer->name = $request->name;
                $customer->email = $request->email;
                $customer->phone_number = $request->phone_number;
                $customer->address = $request->address;
                $customer->gender = $request->gender;
                $customer->dob = $request->dob;
                $customer->save();

                $account = new Account();
                $account->customer_id = $customer->id;
                $account->username = $request->username;
                $account->password = Hash::make($request->password);
                $account->OTP = rand(100000, 999999);
                $account->OTP_expired = date_create()->modify("+5 minutes");
                $account->save();
                DB::commit();

        } catch (Exception $e) {
            DB::rollBack();
            return ["status" => "fail", "error" => $e->getMessage()];
        }
        return ["status" => "OK", "error" => ""];
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "username" => "required",
            "password" => "required|min:8",
        ], [
            "username.required" => "Tên đăng nhập không được để trống!",
            "password.required" => "Mật khẩu không được để trống!",
            "password.min" => "Mật khẩu phải nhiều hơn 8 ký tự",

        ]);
        if ($validator->fails()) {
            return ["error" => $validator->errors(), "status" => "fail"];
        }
        $account = Account::find($request->username);
        if ($account != null) {
            if (Hash::check($request->password, $account->password)) {
                return ["status" => "OK", "error" => ""];
            };
            return ["status" => "fail", "error" => "Password wrong!"];
        }
        return ["status" => "fail", "error" => "This account is not exist!"];
    }
}
