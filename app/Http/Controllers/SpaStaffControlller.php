<?php

namespace App\Http\Controllers;

use App\Models\Staff;

use Illuminate\Http\Request;

class SpaStaffControlller extends Controller
{
    //view all staff
    function getIndexStaff(){
        $staff = Staff::all();
        return view('staff.admin',compact('staff'));
        // create view admin trong folder staff
    }
    // hien form
    function Formadd(){
        return view('staff.formAdd');
        // tạo một formAdd trong folder staff
    }

    // lưu thông tin 
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email'=> 'required',
            'address'=> 'required',
            'gender'=> 'required',
            'dob'=> 'required',
            'phone'=> 'required',
            'salary'=> 'required',

        ]);
        Staff::create($request -> all());
        return redirect()->route('staff.admin')->with('success','1 new staff created sucessfully');
    }

    // edit staff
    
    // hiện form edit 
    public function edit($id){
        $staff= Staff::find($id);
        return view('staff.edit');
        // tạo view form edit trong folder staff nhen
    }
    public function update(Request $request,$id){
        $request->validate([
            'name' => 'required',
            'email'=> 'required',
            'address'=> 'required',
            'gender'=> 'required',
            'dob'=> 'required',
            'phone'=> 'required',
            'salary'=> 'required',

        ]);
        $staff = Staff::find($id);
        $staff->update($request->all());

        return redirect()->route('staff.admin')->with('success','1 staff updated sucessfully');
    }
    // bỏ trong button edit nhen

    // delete 
    function DeleteStaff($id){
        // Trong view show admin Customer, truyen vao trong button xoa
        $staff = Staff::find($id);
        $staff -> delete();
        return redirect()->route('staff.admin')->with('success','Delete Successfully');
        // Tro den route show admin staff
    }

    
}
