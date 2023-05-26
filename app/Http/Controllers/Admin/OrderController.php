<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::orderBy('reservation_date')->get();
        $users = User::all();
        $ordersCount = Order::count();
        $order = Order::first();
        $products = Product::all();

        return view('admin.orders.index',  [
            'page_title' => ' الطلبات',
            'orders' => $orders,
            'order' => $order,
            'products' => $products,
            'users' => $users,
            'ordersCount' => $ordersCount,
    ]);
    }

    public function create()
    {
        // $users = User::all();
        // $products = Product::all();
    
        // return view('admin.orders.create', compact('users', 'products'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'product_id' => 'required',
            'amount' => 'required',
            'price' => 'required',
            'discount' => 'required',
            'deposit' => 'required',
            'status' => 'required',
            // 'total_price' => 'required',
            'reservation_date' => 'required',
        ]);
    
        $code = random_int(100000, 999999);

        // check if the code already exists in the database
        while (Order::where('code', $code)->exists()) {
            // if it does, generate a new code
            $code = random_int(100000, 999999);
        }
        Order::create([
            'user_id' => $request->user_id,
            'product_id' => $request->product_id,
            'amount' => $request->amount,
            'price' => $request->price,
            'discount' => $request->discount,
            'deposit' => $request->deposit,
            'status' => $request->status,
            'code' => $code,
            'total_price' => ($request->price * $request->amount)- $request->discount,
            'reservation_date' => $request->reservation_date,
        ]);

    
        return redirect()->route('dashboard.orders.index')->with('success', 'Order created successfully.');
    }
    
    
//     public function showInvoice($id)
// {
//     $order = Order::findOrFail($id);
//     return view('admin.orders.invoice', compact('order'));
// }


    public function show($id)
    {
     
        $order = Order::findOrFail($id);
        return view('admin.orders.invoice', compact('order'));
    }

    public function edit(Order $order)
    {
        return view('admin.orders.edit', compact('order'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required',
            'product_id' => 'required',
            'amount' => 'required',
            'price' => 'required',
            'discount' => 'required',
            'deposit' => 'required',
            'status' => 'required',
            // 'total_price' => 'required',
            'reservation_date' => 'required',
        ]);
    
        $order = Order::findOrFail($id);
        $order->update([
            'user_id' => $request->user_id,
            'product_id' => $request->product_id,
            'amount' => $request->amount,
            'price' => $request->price,
            'discount' => $request->discount,
            'deposit' => $request->deposit,
            'status' => $request->status,
            'total_price' => ($request->price * $request->amount)- $request->discount,
            'reservation_date' => $request->reservation_date,
        ]);
    
        return redirect()->route('dashboard.orders.index')->with('success', 'Order updated successfully.');
    }
    

    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()->route('dashboard.orders.index')->with('success', 'Order deleted successfully.');
    }
}
