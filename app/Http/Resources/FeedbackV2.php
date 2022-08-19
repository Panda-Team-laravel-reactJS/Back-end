<?php

namespace App\Http\Resources;

use App\Models\Booking;
use Illuminate\Database\Eloquent\Collection;

class FeedbackV2
{
    public static function toArray(Collection $collection)
    {
        return array_map(fn($ele) => [
            "id" => $ele["id"],
            "customer" => Booking::find($ele["booking_id"])->customer->name,
            "content" => $ele["content"],
            "createdAt" => $ele["created_at"]
        ], $collection->toArray())
        ;
    }
}
