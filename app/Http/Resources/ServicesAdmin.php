<?php

namespace App\Http\Resources;

use App\Models\Service;
use Illuminate\Database\Eloquent\Collection;

class ServicesAdmin
{
    public static function toArray(Collection $collection)
    {
        return array_map(fn ($ele) => [
            "id" => $ele["id"],
            "name" => $ele["name"],
            "image" => $ele["image"],
            "description" => $ele["description"],
            "price" => $ele["price"],
            "duration" => $ele["duration"],
            "isDisplayed" => $ele["is_displayed"],
            "displayAtHome" => $ele["display_at_home"],
            "categoryName" => Service::find($ele["category_id"])->category->name
        ], $collection->toArray());
    }

    //return parent::toArray($request);
}
