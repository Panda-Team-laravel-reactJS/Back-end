<?php 
namespace App\Core\AdminLogin;

use App\Core\Constants\SessionConstants;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminLogin {
    public static function login(Request $request) {
        $admin = Admin::find($request->username);
        $check = Hash::check($request->password, $admin->password);
        if ($check) {
            Session::put(SessionConstants::ADMIN, (new AdminSession($admin))->toArray());
        }
        return Session(SessionConstants::ADMIN);
        return $check;
    }
    public static function logout() {
        Session::forget(SessionConstants::ADMIN);
        return redirect()->route("login");
    }
    public static function check() {
        return !empty(Session(SessionConstants::ADMIN));
    }
    public static function admin() {
        return Session(SessionConstants::ADMIN);
    }
    
}
?>