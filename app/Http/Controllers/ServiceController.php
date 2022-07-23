<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Models\Service;
 
class ServiceController extends Controller
{
    //view all staff
    public function index(){
        $services = Service::all();
        return view('pages.services.index',compact('services'));
    }
    // hien form
    public function create(){
        return view('pages.services.create');
    }
 
    // lưu thông tin
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image'=> 'required',
            'description'=> 'required',
            'price'=> 'required',
            'isDisplayed'=> 'required',
            'category_id'=>'required'
        ]);
        Service::create($request -> all());
        return redirect()->route('pages.services.index')->with('success','1 new service created sucessfully');
    }
 
   
    // hiện form edit
    public function edit($id){
        $service= Service::find($id);
        return view('pages.services.edit');
        // tạo view form edit trong folder staff nhen
    }
    public function update(Request $request,$id){
        $request->validate([
            'name' => 'required',
            'image'=> 'required',
            'description'=> 'required',
            'price'=> 'required',
            'isDisplayed'=> 'required',
            'category_id'=>'required'
 
        ]);
        $service = Service::find($id);
        $service->update($request->all());
 
        return redirect()->route('pages.services.index')->with('success','1 services updated sucessfully');
    }
    // delete
    function delete($id){
        $service = Service::find($id);
        $service -> delete();
        return redirect()->route('pages.services.index')->with('success','Delete Successfully');
    }
 
   
}
 
