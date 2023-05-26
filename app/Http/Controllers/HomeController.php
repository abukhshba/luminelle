<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user(); 
        $categories = Category::all();
        return view('home', [
            'user' => $user,
            'categories' => $categories
        ]);
    }

    public function contactUs(){
        $user = Auth::user(); 

        return view ('contactUs.index' ,compact('user'));
    }

    public function termsAndConditions(){
        $user = Auth::user(); 

        return view ('terms.index' ,compact('user'));
    }
}
