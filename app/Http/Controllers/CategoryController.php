<?php
 
namespace App\Http\Controllers;

use App\Core\Constants\SessionConstants;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    //view
    public function index(){
        $categories = Category::all();
        Session::put(SessionConstants::PAGE, "categoriesPage");
        return view('pages.categories.index',compact('categories'));
   
    }
    // hien form
    public function create(){
        return view('pages.categories.create');
    }
 
    // lưu thông tin
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'required'
        ]);
        Category::create($request -> all());
        return redirect()->route('pages.categories.index')->with('success','1 new category created sucessfully');
    }
 
    // edit staff
   
    // hiện form edit
    public function edit($id){
        $category = Category::find($id);
        return view('pages.categories.edit');
    }
    public function update(Request $request,$id){
        $request->validate([
            'name' => 'required',
            'image' => 'required'
        ]);
        $category= Category::find($id);
        $category->update($request->all());
 
        return redirect()->route('pages.categories.index')->with('success','1 categories updated sucessfully');
    }
 
    // delete
    function delete($id){
        $category = Category::find($id);
        $category -> delete();
        return redirect()->route('pages.categories.index')->with('success','Delete Successfully');
    }
 
}

