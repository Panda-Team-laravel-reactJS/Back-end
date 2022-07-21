<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\CategoryResource;
use App\Models\Category;


class ApiCategoryController extends Controller
{
    public function all()
    {
        $categories = Category::get();
        return $categories->isEmpty() ? ["error" => "No data", "status" => false] : new CategoryCollection($categories);
    }
    public function get($id)
    {
        $category = Category::find($id);
        return $category == null ? ["error" => "Can't find this service", "status" => false] : new CategoryResource($category);
    }
}
