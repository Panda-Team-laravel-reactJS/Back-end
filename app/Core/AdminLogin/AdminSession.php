<?php
namespace App\Core\AdminLogin;

use App\Models\Admin;

class AdminSession {
    private string $userName;
    private string $accessToken;
    public function __construct(Admin $admin) {
        $this->userName = $admin->username;
        $this->accessToken = $admin->access_token;
    }
    public function toArray() {
        return [ "userName" => $this->userName, "accessToken" => $this->accessToken ];
    }
}
?>