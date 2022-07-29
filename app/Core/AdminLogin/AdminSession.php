<?php
namespace App\Core\AdminLogin;

use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class AdminSession {
    private string $userName;
    private string $accessToken;
    public function __construct(Admin $admin) {
        $this->userName = $admin->username;
        $this->generateAccessToken($admin);
    }
    public function toArray() {
        return [ "userName" => $this->userName, "accessToken" => $this->accessToken ];
    }
    private function generateAccessToken(Admin $admin) {
        $admin->access_token = Str::random(30);
        $this->accessToken = Hash::make($admin->access_token);
        $admin->save();
    }
}
?>