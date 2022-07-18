<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiCategoryController extends Controller
{ 
    public function all() {
        $categories = Category::get();
        return $categories == null ? ["error"=>"no data", "status"=>"fail"] : new CategoryCollection($categories);
    }
    public function get($id) {
        $category = Category::find($id);
        return $category == null ? ["error" => "can't find this service", "status" => "fail"] : new CategoryResource($category);
    }
}