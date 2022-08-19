<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    public function account() {
        return $this->hasOne(Account::class, "customer_id", "id");
    }
    public function bookings() {
        return $this->hasMany(Booking::class, "booking_id", "id");
    }
}
