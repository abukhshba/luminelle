<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(){

        return view('admin.Login', [
            'page_title' => 'تسجيل الدخول'
        ]);
    }

    public function postLogin(Request $request){

        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $user = false;

        if (is_numeric($request->username)){
            $user = auth('admin')->attempt(['phonenumber' => $request->username, 'password' => $request->password]);
        }else if (filter_var($request->username, FILTER_VALIDATE_EMAIL)){
            $user = auth('admin')->attempt(['email' => $request->username, 'password' => $request->password]);
        }

        if ($user){
            if (session()->has('url.intended')){
                $url = session('url.intended');
                session()->forget('url.intended');
                return redirect($url);
            }

            return redirect()->route('dashboard.home');
        }

        return redirect()->back()->withInput($request->all())->withError('البيانات المدخلة غير صحيحة.');
    }


    public function logout(){
        Auth::logout();
        return redirect('/dashboard/login');

    }
}