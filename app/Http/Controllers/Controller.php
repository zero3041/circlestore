<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Hash;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public function registerCustomer($request, $check)
    {
//        dd($request);
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:customer',
            'phone' => 'numeric',
            'address1' => 'required',
            'address2' => 'required',
            'address3' => 'required',
            'city' => 'required',
            'active' => 'nullable|boolean',
            'password' => 'required|min:6|max:32',
            'password_confirm' => 'required|same:password'
        ],[
            'name.required' => 'Vui lòng nhập họ tên',
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Email không đúng định dạng',
            'email.unique' => 'Email đã được đăng ký',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.min' => 'Mật khẩu phải ít nhất 6 kí tự',
            'password.max' => 'Mật khẩu không quá 32 kí tự',
            'phone.numeric' => 'Số điện thoại không đúng định dạng',
            'city.required' => 'Vui lòng nhập tỉnh (thành phố)',
            'address1.required' => 'Vui lòng nhập quận (huyện)',
            'address2.required' => 'Vui lòng nhập phường (xã)',
            'address3.required' => 'Vui lòng nhập số nhà (xóm, thôn, tổ)',
            'active.boolean' => 'Tình trạng tài khoản không đúng định dạng',
            'password_confirm.required' => 'Vui lòng nhập xác nhận mật khẩu',
            'password_confirm.same' => 'Xác nhận mật khẩu không khớp',
        ]);
        $customer = new Customer;
        $customer->name = $request->name;
        $customer->phone_number = $request->phone;
        $customer->email = $request->email;
        $customer->city = $request->city;
        $customer->address1 = $request->address1;
        $customer->address2 = $request->address2;
        $customer->address3 = $request->address3;
        if($check == 'admin'){
            $customer->active = $request->active;
        }
        $customer->id_lang = 1;
        $customer->password = Hash::make($request->password);
//        $web->reset_password = md5(rand(10,999999999999));
        $customer->save();
    }
    public function postEditAccount($request, $check,$id)
    {
//        dd($request);
        if ($request->password === null)
        {
            $request->validate([
                'name' => 'required',
                'phone' => 'numeric',
                'address1' => 'required',
                'address2' => 'required',
                'address3' => 'required',
                'city' => 'required',
                'active' => 'nullable|boolean',
                'birthday' => 'nullable|date_format:d-m-Y',
            ],[
                'name.required' => 'Vui lòng nhập họ tên',
                'password.required' => 'Vui lòng nhập mật khẩu',
                'password.min' => 'Mật khẩu phải ít nhất 6 kí tự',
                'password.max' => 'Mật khẩu không quá 32 kí tự',
                'country.integer' => 'Vui lòng chọn lại đất nước',
                'phone.numeric' => 'Số điện thoại không đúng định dạng',
                'city.required' => 'Vui lòng nhập tỉnh (thành phố)',
                'address1.required' => 'Vui lòng nhập quận (huyện)',
                'address2.required' => 'Vui lòng nhập phường (xã)',
                'address3.required' => 'Vui lòng nhập số nhà (xóm, thôn, tổ)',
                'active.boolean' => 'Tình trạng tài khoản không đúng định dạng',
                'gender.boolean' => 'Giới tính không đúng định dạng',
                'birthday.date' => 'Ngày sinh không đúng định dạng',
            ]);
        }
        else {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:customer',
                'phone' => 'numeric',
                'address1' => 'required',
                'address2' => 'required',
                'address3' => 'required',
                'city' => 'required',
                'active' => 'nullable|boolean',
                'password' => 'required|min:6|max:32',
                'password_confirm' => 'required|same:password'
            ],[
                'name.required' => 'Vui lòng nhập họ tên',
                'email.required' => 'Vui lòng nhập email',
                'email.email' => 'Email không đúng định dạng',
                'email.unique' => 'Email đã được đăng ký',
                'password.required' => 'Vui lòng nhập mật khẩu',
                'password.min' => 'Mật khẩu phải ít nhất 6 kí tự',
                'password.max' => 'Mật khẩu không quá 32 kí tự',
                'phone.numeric' => 'Số điện thoại không đúng định dạng',
                'city.required' => 'Vui lòng nhập tỉnh (thành phố)',
                'address1.required' => 'Vui lòng nhập quận (huyện)',
                'address2.required' => 'Vui lòng nhập phường (xã)',
                'address3.required' => 'Vui lòng nhập số nhà (xóm, thôn, tổ)',
                'active.boolean' => 'Tình trạng tài khoản không đúng định dạng',
                'password_confirm.required' => 'Vui lòng nhập xác nhận mật khẩu',
                'password_confirm.same' => 'Xác nhận mật khẩu không khớp',
            ]);
        }


        $customer = Customer::find($id);
        $customer->name = $request->name;
        $customer->phone_number = $request->phone;
        $customer->email = $request->email;
        $customer->city = $request->city;
        $customer->address1 = $request->address1;
        $customer->address2 = $request->address2;
        $customer->address3 = $request->address3;
        if($check == 'admin'){
            $customer->active = $request->active;
        }
        $customer->id_lang = 1;
//        $web->reset_password = md5(rand(10,999999999999));
        if($request->password != null){
            $customer->password = Hash::make($request->password);
            $customer->reset_password = md5(rand(10,999999999999));
        }
        $customer->save();
    }
}
