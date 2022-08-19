<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    public function feedbacks() {
        return $this->hasMany(FeedBack::class, "booking_id", "id");
    }
    public function customer() {
        return $this->belongsTo(Customer::class, "customer_id", "id");
    }
    public function schedule() {
        return $this->belongsTo(Schedule::class, "schedule_id", "id");
    }
}
