<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ApiCustomerController extends Controller
{
    public function get($id)
    {
        $customer = Customer::find($id);
        return $customer == null ? ["error" => "Can't find this customer", "status" => false] : new CustomerResource($customer);
    }

    public function edit(Request $req, $id)
    {
        $validator = Validator::make($req->all(), [
            "name" => "required|string",
            "email" => "required|email",
            "phone_number" => "required|numeric|digits:10",
            "address" => "required",
            "gender" => "required|in:Male,Female,Others",
            "dob" => "required|date"
        ], [


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
            return ["error" => $validator->errors(), "status" => false];
        }
        
        try {
            $customer = Customer::find($id);
            $customer->name = $req->name;
            $customer->email = $req->email;
            $customer->phone_number = $req->phone_number;
            $customer->address = $req->address;
            $customer->gender = $req->gender;
            $customer->dob = $req->dob;
            $customer->save();

            return ["error" => "", "status" => "created", "data" => $customer];
        } catch (Exception $e) {
            return ["error" => $e->getMessage(), "status" => false];
        }
    }
}
