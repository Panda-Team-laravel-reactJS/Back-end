<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\StaffCollection;
use App\Http\Resources\StaffResource;
use App\Models\Staff;


class ApiStaffController extends Controller
{
    public function getAll()
    {
        $staff = Staff::get();
        return $staff == null ? ["error" => "No data", "status" => false] : new StaffCollection($staff);
    }
    public function getOne($id)
    {
        $staff = Staff::find($id);
        return $staff == null ? ["error" => "Can't find this staff", "status" => false] : new StaffResource($staff);
    }
}
