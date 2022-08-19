<?php
 
namespace App\Http\Controllers;

use App\Core\Constants\SessionConstants;
use App\Http\Resources\FeedbackV2;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
 
 
class FeedbackController extends Controller
{
    // chi duoc phep view thoi
    public function index(){
        $feedbacks = FeedbackV2::toArray(Feedback::get());
        // return $feedbacks;
        Session::put(SessionConstants::PAGE, "feedbackPage");
        return view('pages.feedback.index',compact('feedbacks'));
    }
}

