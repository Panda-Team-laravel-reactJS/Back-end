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
    public function getInfo(Request $request)
    {
        $customer = Customer::find($request->customerId);
        return ["status" => true, "info" => new CustomerResource($customer)];
    }

    public function edit(Request $req)
    {
        $validator = Validator::make($req->all(), [
            "phoneNumber" => "required|numeric|digits:10",
            "address" => "required",
        ], [
            "phoneNumber.required" => "Số điện thoại không được để trống",
            "phoneNumber.numeric" => "Số điện thoại không được chứa ký tự",
            "phoneNumber.digits" => "Số điện thoại gồm 10 kí tự",
            "address.required" => "Địa chỉ không được để trống!",
        ]);

        if ($validator->fails()) {
            return ["errors" => $validator->errors(), "status" => false];
        }

        try {
            $customer = Customer::find($req->customerId);
            $customer->phone_number = $req->phoneNumber;
            $customer->address = $req->address;
            $customer->save();

            return ["errors" => null, "status" => true, "data" => $customer];
        } catch (Exception $e) {
            return ["errors" => $e->getMessage(), "status" => false];
        }
    }
}
