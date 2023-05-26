<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    
    public function bookNow($id){
        $product = Product::findOrFail($id);
        $user = Auth::user(); 
         $categoryID = $product->category->id;
         $categoryName = $product->category->name;
        return view('orders.booknow',compact('product' , 'user' , 'categoryID' , 'categoryName'));
    }

    public function contact(){
        $user = Auth::user(); 
       
        return view('orders.contact',compact('user'));
    }


    public function create(Request $request )
    {
        // Retrieve the form data
        $user_id = auth()->user()->id;
        $product_id = $request->input('product_id');
        $price = $request->input('price');
        $status = $request->input('status');
        $deposit = $request->input('deposit');
        $reservation_date = $request->input('reservation_date');
    
        $code = random_int(100000, 999999);
    
        // check if the code already exists in the database
        while (Order::where('code', $code)->exists()) {
            // if it does, generate a new code
            $code = random_int(100000, 999999);
        }
        
        // Create the order
        $order = new Order();
        $order->user_id = $user_id;
        $order->product_id = $product_id;
        $order->price = $price;
        $order->status = $status;
        $order->deposit = $deposit;
        $order->code = $code;
        $order->reservation_date = $reservation_date;
        
        $order->save();
    
        // Redirect to a success page or perform any other necessary actions
        return redirect()->route('orders.contact');
    }
    
}

    

