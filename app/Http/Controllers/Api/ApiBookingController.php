<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

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
        $validator = Validator::make(
            $request->all(),
            [
                "service" => "required:exists:App\Models\Service,id",
                "expectedDate" => "required|date|after_or_equal:now",
                "expectedTime" => "required"
            ],
            [
                "service.required" => "Bạn chưa chọn dịch vụ!",
                "service.exists" => "Dịch vụ không tồn tại!",
                "expectedDate.required" => "Ngày dự kiến không được để trống!",
                "expectedDate.after_or_equal" => "Ngày dự kiến lớn hơn hằng bằng hôm nay!",
                "expectedTime.required" => "Giờ dự kiến không được để trống!",
            ]
        );
        if ($validator->fails()) {
            return ["status" => false, "errors" => $validator->errors()];
        }
        try {
            $booking = new Booking();
            $booking->customer_id = $request->customerId;
            $booking->service_id = $request->service;
            $booking->booking_date = date_create()->format("Y-m-d H:i:s");
            $booking->expected_date = $request->expectedDate;
            $booking->expected_time = $request->expectedTime;
            $booking->save();
        } catch (Exception $e) {
            return ["status" => false, "errors" => $e->getMessage()];
        }
        return ["status" => true, "errors" => null];
    }
}
