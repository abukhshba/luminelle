<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\User;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::all();
        $orders = Order::all();
        $users = User::all();
        $paymentscount = Payment::count();
        return view('admin.payments.index',[
            'page_title' => ' المدفوعات',
            'payments' => $payments,
            'paymentsCount' => $paymentscount,
            'orders' => $orders,
            'users' => $users,
        ]);
    }

    public function create()
    {
        return view('admin.payments.create');
    }



    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'payment_method' => 'required|in:فورى,فودافون كاش,بطاقة ائتمان',
            'order_id' => 'required|exists:orders,id',
        ]);
    
        $order = Order::findOrFail($request->order_id);
    
        $remain = $order->total_price - $request->amount;
    
        $payment = new Payment([
            'amount' => $request->amount,
            'payment_method' => $request->payment_method,
            'order_id' => $request->order_id,
            'user_id' => $request->user_id,
            'remain' => $remain,
        ]);
    
        $payment->save();
    
        return redirect()->route('dashboard.payments.index')->with('success', 'تم إضافة المدفوعات بنجاح.');
    }
    

    public function edit($id)
    {
        // $payment = Payment::find($id);
        // return view('payments.edit', compact('payment'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'payment_method' => 'required|in:فورى,فودافون كاش,بطاقة ائتمان',
            'order_id' => 'required|exists:orders,id',
        ]);

        $payment = Payment::findOrFail($id);

        $order = Order::findOrFail($payment->order_id);

        $remain = $order->total_price - $request->amount;

        $payment->amount = $request->amount;
        $payment->payment_method = $request->payment_method;
        $payment->user_id = $request->user_id;
        $payment->remain = $remain;

        $payment->save();

        return redirect()->route('dashboard.payments.index')->with('success', 'تم تحديث المدفوعات بنجاح.');
    }


    public function destroy($id)
    {
        $payment = Payment::find($id);
        $payment->delete();

        return redirect()->route('dashboard.payments.index')->with('success', 'Payment deleted successfully');
    }
}
