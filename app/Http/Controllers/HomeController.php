<?php

namespace App\Http\Controllers;

use App\Core\AdminLogin\AdminLogin;
use App\Core\Constants\SessionConstants;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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
    public function logout() {
        AdminLogin::logout();
        return redirect()->route("login");
    }
    public function index()
    {
        Session::put(SessionConstants::PAGE, "homePage");
        return view("pages.index");
    }
}
