<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;
    public function jobs() {
        return $this->hasMany(Job::class, "staff_id", "id");
    }
    public function schedules() {
        return $this->hasManyThrough(Job::class, Schedule::class);
    }
}

