<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Addcart;
use App\Models\Product;
use App\Models\Vendor;
use App\Models\Customer;
use App\Models\Neworder;

class OrderViewController extends Controller
{
    public function FtoC_Orderlist()
    {
        if(session('role')=='admin'){
            $p= session('role') == 'customer';
            $orders = Neworder::where('role', '=', $p)->get();
            $customers = Customer::all();
            
            return view('pages.admin.customer_farmerOrder', compact('orders', 'customers'));
            // dd($data);
            // exit();
        }

        
        
    }
}
