<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ServiceCollection;
use App\Http\Resources\ServiceResource;
use App\Models\Service;
use Illuminate\Http\Request;

class ApiServiceController extends Controller
{
    public function all(Request $request)
    {
        $services = Service::where("is_displayed", 1);
        if (!empty($request->displayAtHome)) {
            $services = $services->where("display_at_home", 1);
        }
        $services = $services->get();
        return $services->isEmpty() ? ["error" => "No data", "status" => false] : new ServiceCollection($services);
    }
    public function get($id)
    {
        $services = Service::find($id);
        return $services == null ? ["error" => "Can't find this service", "status" => false] : new ServiceResource($services);
    }
}
