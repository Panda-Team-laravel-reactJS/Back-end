<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;
    public function services() {
        return $this->belongsTo(Service::class, "service_id", "staff_id");
    }
    public function staff() {
        return $this->belongsTo(SpaStaff::class, "staff_id", "staff_id");
    }
    public function schedules($staffId, $serviceId) {
        return Schedule::where("staff_id", $staffId)->where("service_id", $serviceId);
    }
}
