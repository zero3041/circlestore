<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Mail\sendMailRegister;
use App\Mail\sendMailResetPassword;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class CustomerController extends Controller
{
    public function index()
    {
        $category = CategoryController::getMenuByname('laptop');
        return view('web.pages.login',with([
            'category' => $category
        ]));
    }
    public function register()
    {

        $category = CategoryController::getMenuByname('laptop');
        return view('web.pages.register',with([
            'category' => $category
        ]));
    }
    public function postRegister(Request $request)
    {
        $this->registerCustomer($request, $check = 'front');
        if(Auth::guard('customer')->attempt(['email'=>$request->email, 'password'=>$request->password, 'active' =>1])){
            Mail::to($request->email)->send(new sendMailRegister($request->email, $request->password));
            return view('web.pages.register')->with(['status'=> true]);
        }
        return view('front.pages.register');
    }
    public function resetPassword()
    {
        $category = CategoryController::getMenuByname('laptop');
        return view('web.pages.forgot_password',with([
            'category' => $category
        ]));
    }
    public function postResetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ],[
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Email không đúng định dạng',
        ]);
        $customer = Customer::where('email', $request->email)->first();
        if($customer == null){
            return redirect()->route('resetPassword')->with('status','Email bạn vừa nhập không có trong hệ thống của chúng tôi. Nếu bạn chưa có tài khoản, vui lòng đăng ký.');

        }
        $hash = md5($customer->reset_password.$request->email);
        Mail::to($request->email)->send(new sendMailResetPassword($customer->name, $request->getHost().'/customer/password/reset/check?hash='.$hash.'&id='.$customer->id_customer));
        return redirect()->route('resetPassword')->with('status','Chúng tôi đã gửi đường dẫn lấy lại mật khẩu trong email của bạn. Vui lòng kiểm tra email và làm theo hướng dẫn.');
    }
    public function checkResetPassword(Request $request)
    {
        $category = CategoryController::getMenuByname('laptop');
        $customer = Customer::find($request->id);
        if($customer){
            $hash = md5($customer->reset_password.$customer->email);
            if($hash == $request->hash){
                if($request->has('auth')){
//                    $customer->reset_password = md5(rand(10,999999999999));
                    $customer->save();
                    return view('web.pages.checkResetPassword')->with(['category'=>$category,'check' => true, 'id' => $request->id, 'hash' => $hash, 'auth' => 1]);
                }
                return view('web.pages.checkResetPassword')->with(['category'=>$category,'check' => true, 'id' => $request->id, 'hash' => $hash]);
            }
        }
        return view('web.pages.checkResetPassword')->with(['category'=>$category,'check' => false, 'id' => 0, 'hash' => '']);
    }
    public function postCheckResetPassword(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'hash' => 'required',
            'password' => 'required|min:6|max:32',
            'password_confirm' => 'required|same:password'
        ],[
            'id.required' => 'Vui lòng thử lại sau',
            'id.integer' => 'Vui lòng thử lại sau',
            'hash.required' => 'Vui lòng thử lại sau',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.min' => 'Mật khẩu phải ít nhất 6 kí tự',
            'password.max' => 'Mật khẩu không quá 32 kí tự',
            'password_confirm.required' => 'Vui lòng nhập xác nhận mật khẩu',
            'password_confirm.same' => 'Xác nhận mật khẩu không khớp',
        ]);
        $customer = Customer::find($request->id);
        if($customer){
            $hash = md5($customer->reset_password.$customer->email);
            if($hash == $request->hash){
                if(!Hash::check($request->password, $customer->password)){
                    $customer->password = Hash::make($request->password);
//                    $customer->reset_password = md5(rand(10,999999999999));
                    $customer->save();
                    $hash = md5($customer->reset_password.$customer->email);
                    return redirect()->route('checkResetPassword',['hash' => $hash, 'id' => $request->id, 'auth' => 1])->withErrors([ 'status' => 'Đổi mật khẩu thành công.']);
                }else{
                    return redirect()->route('checkResetPassword',['hash' => $hash, 'id' => $request->id])->withErrors(['status' => 'Trùng mật khẩu cũ, vui lòng nhập lại.']);
                }
            }else{
                return redirect()->route('checkResetPassword',['hash' => $hash, 'id' => $request->id])->withErrors(['status' => 'Đổi mật không thành công.']);
            }

        }
        return redirect()->route('checkResetPassword',['hash' => $request->hash, 'id' => $request->id])->withErrors([ 'status' => 'Đổi mật khẩu thất bại.']);
    }
    public function wishlist()
    {
        $category = CategoryController::getMenuByname('laptop');
        return view('web.pages.wishlist',with([
            'category' => $category
        ]));
    }
}
