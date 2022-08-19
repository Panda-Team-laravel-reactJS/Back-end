<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    public function jobs() {
        return $this->hasMany(Job::class, "service_id", "id");
    }
    public function category()
    {
        return $this->belongsTo(Category::class, "category_id", "id");
    }
    public function schedules() {
        return $this->hasManyThrough(Job::class, Schedule::class);
    }
}
