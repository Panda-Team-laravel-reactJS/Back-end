<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    public function bookings() {
        return $this->hasMany(Booking::class, "schedule_id", "schedule_id");
    }
}
