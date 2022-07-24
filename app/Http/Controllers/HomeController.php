<?php

namespace App\Http\Controllers;

use App\Core\AdminLogin\AdminLogin;
use App\Models\Admin;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function login(Request $request)
    {
        $request->validate(
            [
                "username" => "required|exists:App\Models\Admin,username",
                "password" => "required"
            ],
            [
                "username.required" => "Tài khoản đăng nhập không được để trống!",
                "username.exists" => "Tài khoản không tồn tại! Vui lòng thử lại.",
                "password.required" => "Mật khẩu rỗng! Vui lòng thử lại."
            ]
        );
        if (AdminLogin::login($request)) {
            return redirect()->route("home.index");
        }
        return view("pages.login", ["pwdError" => "Mật khẩu sai! Vui lòng thử lại."]);
    }
    public function index()
    {
        return view("pages.index");
    }
}
