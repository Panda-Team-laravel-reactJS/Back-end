<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Account;
class CustomerController extends Controller
{
    //view customer
    public function index(){
        $customers = Customer::join("accounts", "customers.id", "=", "accounts.customer_id")
                                ->get();
        return view('pages.customers.index',compact('customers'));
        // create view admin trong folder customers
    }
    // Delete 1 customer 
    public function delete($username){
        // Trong view show admin Customer, truyen vao trong button xoa
        $customer = Customer::find($username);
        $customer->delete();
        return redirect()->route('customers.index')->with('success','Delete Successfully');
        // Tro den route show admin customers
    }
    public function ban($username){
        $customer = Customer::find($username);
        $customer->is_banned = true;
        $customer->save();
        return redirect()->route('customers.index');
    }
    public function unBan($username) {
        $customer = Customer::find($username);
        $customer->is_banned = false;
        $customer->save();
        return redirect()->route('customers.index');
    }
}
