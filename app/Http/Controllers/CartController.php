<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Addcart;
use App\Models\Product;
use App\Models\Vendor;
use App\Models\Customer;
use App\Models\Neworder;
use App\Models\ProductRating;
class CartController extends Controller
{
   
    public function addtocart(Request $request, $id){
        
        $cart = new Addcart();
        $products = Product::find($id);
        $cart->productName = $products->name;
        $cart->quantity = $request->quantity;
        $cart->price = $request->price;
        
        $cart->total_price = $request->quantity * $request->price;
        $cart->productId = $products->id;
        $cart->cartid = $request->cartid;
        $cart->role = $request->role;
        $cart->name = $request->name;
        $cart->address = $request->address;
        $cart->phone = $request->phone;
        // dd($cart);
        // exit();
        $cart->save();

        return redirect('/');
    }

    public function showcart($id){
        if(session('role')=='customer'){
            $p= session('name');
            $customers = Customer::find($id);
            $customer = Customer::where('id', $customers->id)->first();
            $cart = Addcart::where('name', '=', $p)->get();
            //dd($cart);
        }
        
        else if(session('role')=='vendor'){
            $p= session('name');
            $vendors = Vendor::find($id);
            $vendor = Vendor::where('id', $vendors->id)->first();
            $cart = Addcart::where('name', '=', $p)->get();
        }
        //dd($cart);
        //dd($vendor);
        //exit();
        return view('pages.order.showcart', compact('cart'));
    }

    public function remove_cart($id){
        
        $cart = Addcart::find($id);
        $cart->delete();
        return redirect()->back();    
    }
    /////       ORDER ////
    public function cash_order(){
        $p= session('name');
        $data = Addcart::where('name', '=', $p)->get();
        // dd($data);
        //     exit();
        foreach($data as $d){
            $order =new Neworder();
            $order->role = $d->role;
            $order->name = $d->name;
            $order->address = $d->address;
            $order->phone = $d->phone;
            $order->productId = $d->productId;
            $order->productName = $d->productName;
            $order->price = $d->price;
            $order->total_price = $d->total_price;
            $order->quantity = $d->quantity;
            $order->payment_status = "Cash On Delivery";
            $order->delivery_status = "Processing";
            
           $order->save();

            //delete cart 
            $cart_name = $d->id;
            $cart = Addcart::find($cart_name);
            // dd($cart);
            // exit();
            $cart->delete();
            

        }
        // dd($customer);
        
        return redirect()->back();    
    }

    public function backproduct(Request $id){
        $customer=Customer::find($id);
        
        $allProducts = Product::paginate(8);
        $ratings = ProductRating::all();
        return view(
            'pages.product.allProducts',
            ['allProducts' => $allProducts],
            ['ratings' => $ratings],
            compact('customer')
        );
        return view ( 'pages.customer.customerProducts');
    }


    public function customerOrders($id)
    {
        if(session('role')=='customer'){
            $p= session('name');
            $orders = Neworder::where('name', '=', $p)->get();
            $customers = Customer::find($id);
            $customer = Customer::where('id', $customers->id)->first();
            return view('pages.customer.customerOrders', compact('orders', 'customer'));
            // dd($data);
            // exit();
        }
        
    }
   
}
