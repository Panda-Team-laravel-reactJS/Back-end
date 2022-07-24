<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\FeedbackCollection;
use App\Http\Resources\FeedbackResource;
use App\Models\FeedBack;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ApiFeedbackController extends Controller
{
    public function post(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "content" => "required",
            "bookingId" => "required|exists:App\Models\Booking, id"

        ], [
            "content.required" => "Nội dung không được để trống!",
            "bookingId.required" => "Booking id không được để trống!",
            "bookingId.exists" => "Booking id khoog tồn tại! "
        ]);
        if ($validator->fails()) {
            return ["error" => $validator->errors(), "status" => false];
        }

        try {

            $feedback = new FeedBack();
            $feedback->booking_id = $request->bookingId;
            $feedback->content = $request->content;
            $feedback->save();
        } catch (Exception $e) {

            return ["status" => false, "error" => $e->getMessage()];
        }
        return ["status" => true, "error" => ""];
    }
    public function get($id)
    {
        $feedback = Feedback::find($id);
        return $feedback == null ? ["error" => "Can't find this feedback", "status" => false] : new FeedbackResource($feedback);
    }
    public function getFeedbackByBooking($bookingId)
    {
        $feedback = Feedback::find($bookingId);
        return $feedback == null ? ["error" => "Can't find this feedback", "status" => false] : new FeedbackResource($feedback);
    }
    public function all()
    {
        $feedback = FeedBack::get();
        return $feedback == null ? ["error" => "No data", "status" => false] : new FeedbackCollection($feedback);
    }
}
