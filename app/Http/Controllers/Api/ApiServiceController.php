<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Resources\ServiceCollection;
use App\Http\Resources\ServiceResource;
use App\Models\Services;


class ApiServiceController extends Controller
{ 
    public function getAll() {
        $services = Services::get();
        return $services == null ? ["error"=>"no data", "status"=>"fail"] : new ServiceCollection( $services);
    } 
    public function getOne($id) {
        $services = Services::find($id);
        return $services == null ? ["error" => "can't find this service", "status" => "fail"] : new ServiceResource( $services);
    }
}