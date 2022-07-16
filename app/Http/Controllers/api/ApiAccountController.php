<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;

class ApiAccountController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "username" => "required",
            "password" => "required|min:8",
            "name" => "required"
        ]); 

        if ($validator->fails()) {
            return;
        }
        // save account
        $account = new Account();
        $account->username = $request->username;
        $account->password = Hash::make($request->password);
        $account->OTP = rand(100000, 999999);
        $account->OTP_expired = date_create();
        $account->save();
        // save customer infor
        $customer = new Customer();
        $customer->name = $request->name;
        //....

        $customer->save();
    }
    public function verify(Request $request) {

    }
    public function login(Request $request) {
        // validate

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
