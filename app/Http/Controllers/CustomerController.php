<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Account;
class CustomerController extends Controller
{
    //view customer
    function getIndexCustomer(){
        $customers = Customer::all();
        return view('customers.admin',compact('customers'));
        // create view admin trong folder customers
    }
    // Delete 1 customer 
    function DeleteCustomer($id){
        // Trong view show admin Customer, truyen vao trong button xoa
        $customers = Customer::find($id);
        $customers -> delete();
        return redirect()->route('customers.admin')->with('success','Delete Successfully');
        // Tro den route show admin customers
    }
    function BanCustomer(){
        //

    }

}
