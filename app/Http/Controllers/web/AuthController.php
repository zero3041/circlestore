<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        $category = CategoryController::getMenuByname('laptop');
        return view('web.pages.login',with([
            'category' => $category
        ]));
    }
    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6|max:32'
        ],[
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Email không đúng định dạng',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.min' => 'Mật khẩu phải ít nhất 6 kí tự',
            'password.max' => 'Mật khẩu không quá 32 kí tự',
        ]);
        $remember = $request->has('remember') ? true : false;
        if (Auth::viaRemember()) {
            return redirect()->route('index');
        }

        if(Auth::guard('customer')->attempt(['email'=>$request->email, 'password'=>$request->password, 'active' =>1],$remember)){
            return redirect()->route('index');
        }

        return redirect()->back()->with('status','Đăng nhập thất bại');
    }
    public function logout(Request $request)
    {
        Auth::guard('customer')->logout();
        return redirect()->route('index');
    }
}
