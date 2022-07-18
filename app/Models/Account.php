<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;
    protected $primaryKey = "customer_id";   
    public function customerInfo() {
        return $this->belongsTo(Customer::class, "customer_id", "customer_id");
    }
}
