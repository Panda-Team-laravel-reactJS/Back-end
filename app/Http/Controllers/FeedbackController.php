<?php
 
namespace App\Http\Controllers;
use App\Models\Feedback;
use Illuminate\Http\Request;
 
 
class FeedbackController extends Controller
{
    // chi duoc phep view thoi
    public function index(){
        $feedback = Feedback::all();
        return view('pages.feeback.index',compact('feedback'));
    }
}

