<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getLogin()
    {
        return view('admin.pages.login');
    }

    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6|max:32'
        ], [
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Email không đúng định dạng',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.min' => 'Mật khẩu phải ít nhất 6 kí tự',
            'password.max' => 'Mật khẩu không quá 32 kí tự',
        ]);
        $remember = $request->has('remember') ? true : false;
        if (Auth::viaRemember()) {
            return redirect()->route('adminDashboard');
        }

        if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password], $remember)) {
            return redirect('admins/dashboard');
        }

        return redirect()->back()->with('status', 'Đăng nhập thất bại');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('adminlogin');
    }

    public function postRegister(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:Users',
            'password' => 'required|min:6|max:32',
            'password_confirm' => 'required|same:password'
        ], [
            'name.required' => 'Vui lòng nhập họ tên',
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Email không đúng định dạng',
            'email.unique' => 'Email đã được đăng ký',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.min' => 'Mật khẩu phải ít nhất 6 kí tự',
            'password.max' => 'Mật khẩu không quá 32 kí tự',
            'password_confirm.required' => 'Vui lòng nhập xác nhận mật khẩu',
            'password_confirm.same' => 'Xác nhận mật khẩu không khớp',
        ]);
        $res = $this->user->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        if ($res->wasRecentlyCreated) {
            return redirect()->back()->with(['error' => false, 'status' => 'Đăng ký thành công']);
        }

        return redirect()->back()->with(['error' => true, 'status' => 'Đăng ký thất bại']);
    }
    public function forgotPassword()
    {
        return view('admin.pages.forgotPassword');
    }
    public function postForgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ],[
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Email không đúng định dạng',
        ]);
    }
}
