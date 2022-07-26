<?php

namespace App\Http\Controllers;

use App\Core\Constants\SessionConstants;
use App\Models\Staff;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SpaStaffController extends Controller
{
    //view all staff
    public function index(){
        $staff = Staff::all();
        Session::put(SessionConstants::PAGE, "staffPage"); 
        return view('pages.staff.index',compact('staff'));
    }
    // hien form
    public function create(){
        return view('pages.staff.create');
        // tạo một formAdd trong folder staff
    }

    // lưu thông tin 
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image'=> 'required',
            'gender'=> 'required',
            'position'=> 'required',
        ]);
        Staff::create($request -> all());
        return redirect()->route('staff.index')->with('success','1 new staff created sucessfully');
    }

    // edit staff
    
    // hiện form edit 
    public function edit($id){
        $staff= Staff::find($id);
        return view('pages.staff.edit');
        // tạo view form edit trong folder staff nhen
    }
    public function update(Request $request,$id){
        $request->validate([
            'name' => 'required',
            'image'=> 'required',
            'gender'=> 'required',
            'position'=> 'required',

        ]);
        $staff = Staff::find($id);
        $staff->update($request->all());

        return redirect()->route('staff.index')->with('success','1 staff updated sucessfully');
    }
    // bỏ trong button edit nhen

    // delete 
    function delete($id){
        // Trong view show admin Customer, truyen vao trong button xoa
        $staff = Staff::find($id);
        $staff -> delete();
        return redirect()->route('staff.index')->with('success','Delete Successfully');
        // Tro den route show admin staff
    }

    
}
