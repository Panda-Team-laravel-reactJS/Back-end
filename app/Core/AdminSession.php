<?php
namespace App\Core;

use App\Models\Admin;

class AdminSession {
    private string $userName;
    private string $accessToken;
    public function __construct(Admin $admin) {
        $this->userName = $admin->username;
        $this->accessToken = $admin->access_token;
    }
    public function getUserName() {
        return $this->userName;
    }
    public function getAccessToken() {
        return $this->accessToken;
    }
}
?>