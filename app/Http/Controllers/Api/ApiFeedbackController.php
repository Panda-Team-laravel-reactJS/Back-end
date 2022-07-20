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
    public function postFeedback(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "content" => "required|string",

        ], [
            "content.required" => "Nội dung không được để trống!",
            "content.string" => "Phản hồi của khách hàng phải bao gồm các ký tự và số "
        ]);
        if ($validator->fails()) {
            return ["error" => $validator->errors(), "status" => false];
        }

        try {

            $feedback = new FeedBack();
            $feedback->booking_id = $request->booking_id;
            $feedback->content = $request->content;
            $feedback->save();
        } catch (Exception $e) {

            return ["status" => false, "error" => $e->getMessage()];
        }
        return ["status" => true, "error" => ""];
    }
    public function getFeedback($id)
    {
        $feedback = Feedback::find($id);
        return $feedback == null ? ["error" => "Can't find this feedback", "status" => false] : new FeedbackResource($feedback);
    }
    public function getFeedbackByBooking($booking_id)
    {
        $feedback = Feedback::find($booking_id);
        return $feedback == null ? ["error" => "Can't find this feedback", "status" => false] : new FeedbackResource($feedback);
    }
    public function getAllFeedback()
    {
        $feedback = FeedBack::get();
        return $feedback == null ? ["error" => "No data", "status" => false] : new FeedbackCollection($feedback);
    }
}
