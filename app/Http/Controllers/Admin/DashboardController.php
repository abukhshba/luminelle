<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Admin;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class DashboardController extends Controller
{
    public function __invoke(){


        $products = Product::count();
        $adminName = Auth::user()->name;        
        $categories = Category::count();
        $admins = Admin::all();

        $usersCount = User::count();
        $ordersCount = Order::count();
        $revenue = Order::sum('total_amount');
       

      
        return view('admin.Dashboard', [
            'page_title' => 'الصفحة الرئيسية',
            'usersCount' => $usersCount,
            'products' => $products,
            'categories' => $categories,
            'orders' => $ordersCount,
            'revenue' => $revenue,
            'orders' => $ordersCount,
            'adminName' => $adminName,
            'admins' => $admins,
           
        ]);
    }
}
