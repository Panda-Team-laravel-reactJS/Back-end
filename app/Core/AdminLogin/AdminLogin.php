<?php 
namespace App\Core\AdminLogin;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminLogin {
    public static function login(Request $request) {
        $admin = Admin::find($request->username);
        $check = Hash::check($request->password, $admin->password);
        if ($check) {
            Session::put(ADMIN, (new AdminSession($admin))->toArray());
        }
        return $check;
    }
    public static function check() {
        return !empty(Session(ADMIN));
    }
    public static function admin() {
        return Session(ADMIN);
    }
    
}
?>