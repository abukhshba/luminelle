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
        $orders = Order::all();
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
        $users = User::all();
        $products = Product::all();
    
        return view('admin.orders.create', compact('users', 'products'));
    }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'user_id' => 'required',
    //         'total_amount' => 'required',
    //         'total_price' => 'required',
    //     ]);

    //     Order::create([
    //         'user_id' => $request->user_id,
    //         'total_amount' => $request->total_amount,
    //         'total_price' => $request->item_price * $request->amount,
    //     ]);
    //     OrderItem::create([
    //         'product_id' => $request->product_id,
    //         'amount' => $request->amount,
    //         'order_id' => $request->order_id,
    //         'item_price' => $request->item_price,
    //         'item_total_price' => $request->item_price * $request->amount,

    //     ]);

    //     return redirect()->route('dashboard.orders.index')->with('success', 'Order created successfully.');
    // }


    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'product_id' => 'required',
            'amount' => 'required',
            'price' => 'required',
            'discount' => 'required',
            // 'total_price' => 'required',
            'reservation_date' => 'required',
        ]);
    
        Order::create([
            'user_id' => $request->user_id,
            'product_id' => $request->product_id,
            'amount' => $request->amount,
            'price' => $request->price,
            'discount' => $request->discount,
            'total_price' => ($request->price * $request->amount)- $request->discount,
            'reservation_date' => $request->reservation_date,
        ]);
    
        return redirect()->route('dashboard.orders.index')->with('success', 'Order created successfully.');
    }
    
    
    

    public function show( $orderId)
    {
     
        $order = Order::findOrFail($orderId);
        $orderItems = $order->items;

        // return view('order_items.index', compact('order', 'orderItems'));
        return view('admin.orders.show', [
            'page_title' => ' وحدات الطلب',
            'order' => $order,
            'orderItems' => $orderItems,
        ]);
    }

    public function edit(Order $order)
    {
        return view('admin.orders.edit', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'user_id' => 'required',
            'total_amount' => 'required',
            'total_price' => 'required',
        ]);

        $order->update([
            'user_id' => $request->user_id,
            'total_amount' => $request->total_amount,
            'total_price' => $request->total_price,
        ]);

        return redirect()->route('dashboard.orders.index')->with('success', 'Order updated successfully.');
    }

    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()->route('dashboard.orders.index')->with('success', 'Order deleted successfully.');
    }
}
