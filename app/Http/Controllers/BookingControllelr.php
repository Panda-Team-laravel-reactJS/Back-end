<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;

class BookingControllelr extends Controller
{
   //view
   public function index(){
    $bookings = Booking::all();
    return view('pages.bookings.index',compact('bookings'));

}

// hoi chi khi khach book thi co duoc cancel hay huy khong
// k can form, customer just register thoi
public function store(Request $request)
{
    Booking::create($request -> all());
    return redirect()->route('pages.bookings.index')->with('success','1 new booking created sucessfully');
}
}
