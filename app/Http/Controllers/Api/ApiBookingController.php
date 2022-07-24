<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class ApiBookingController extends Controller
{
    public function filter(Request $request)
    {
        $filteredBookingSchedules = Booking::select("*");
        if (!empty($request->bookingId)) {
            $filteredBookingSchedules = $filteredBookingSchedules->where("id", $request->bookingId);
        }
        if (!empty($request->startDate)) {
            $filteredBookingSchedules = $filteredBookingSchedules->where("start_time", "like", "%" . $request->startDate . "%");
        }
        if (!empty($request->staffId)) {
            $filteredBookingSchedules = $filteredBookingSchedules->where("staff_id", $request->staffId);
        }
        return $filteredBookingSchedules->get()->isEmpty()
            ? ["error" => "No data has found!", "status" => false]
            : ["error" => "", "status" => true, "data" => $filteredBookingSchedules->get()];
    }
    public function book(Request $request)
    {
        $validator = FacadesValidator::make(
            $request->all(),
            [
                "service_id" => "required:exists:App\Models\Service,id",
                "customer_id" => "required:exists:App\Models\Customer,id",
                "startTime" => "required|date|after_or_equal:now",
                "endTime" => "required|date|after:startTime"
            ],
            []
        );
    }
}
