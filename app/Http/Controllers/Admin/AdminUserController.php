<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    public function getUser()
    {
        $user = User::Paginate(10);
        foreach ($user as $key => $value) {
            switch($value['id_profile']){
                case 0: $user[$key]['id_profile'] = 'Nhân viên'; break;
                case 1: $user[$key]['id_profile'] = 'Quản trị'; break;
            }
        }
        return view('admin.pages.user')->with('user',$user);
    }
    public function addUser()
    {
        return view('admin.pages.editUser');
    }
    public function editUser($id)
    {
        $user = User::find($id);
        if($user!=null){
            $user= $user->toArray();
        }
        return view('admin.pages.editUser')->with('user',$user);
    }
    public function postAddUser(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|max:32',
            'profile' => 'required|integer',
            'phone' => 'nullable|numeric',
            'password_confirm' => 'required|same:password'
        ],[
            'name.required' => 'Vui lòng nhập họ tên',
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Email không đúng định dạng',
            'email.unique' => 'Email đã được đăng ký',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.min' => 'Mật khẩu phải ít nhất 6 kí tự',
            'password.max' => 'Mật khẩu không quá 32 kí tự',
            'profile.required' => 'Vui lòng chọn quyền',
            'profile.integer' => 'Quyền không đúng định dạng',
            'phone.numeric' => 'Số điện thoại không đúng định dạng',
            'password_confirm.required' => 'Vui lòng nhập xác nhận mật khẩu',
            'password_confirm.same' => 'Xác nhận mật khẩu không khớp',
        ]);
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->name = $request->name;
        $user->phone_number = $request->phone;
        $user->id_profile = $request->profile;
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect()->route('adminUser');
    }
    public function postEditUser(Request $request, $id)
    {
        if($request->password == null){
            $request->validate([
                'name' => 'required',
                'phone' => 'nullable|numeric',
            ],[
                'name.required' => 'Vui lòng nhập họ tên',
                'phone.numeric' => 'Số điện thoại không đúng định dạng',
            ]);
        }
        else{
            $request->validate([
                'name' => 'required',
                'password' => 'min:6|max:32',
                'phone' => 'nullable|numeric',
                'password_confirm' => 'required|same:password'
            ],[
                'name.required' => 'Vui lòng nhập họ tên',
                'password.min' => 'Mật khẩu phải ít nhất 6 kí tự',
                'password.max' => 'Mật khẩu không quá 32 kí tự',
                'phone.numeric' => 'Số điện thoại không đúng định dạng',
                'password_confirm.required' => 'Vui lòng nhập xác nhận mật khẩu',
                'password_confirm.same' => 'Xác nhận mật khẩu không khớp',
            ]);
        }
        $user = User::find($id);
        if(!$request->has('profile')){
            $request->profile = 0;
        }
        if($user!=null){
            $user->name = $request->name;
//            $user->name = $request->name;
            $user->phone_number = $request->phone;
            $user->id_profile = $request->profile;
            if($request->password != null){
                $user->password = Hash::make($request->password);
            }
            $user->save();
        }
        return redirect()->route('adminUser');
    }
    public function deleteUser(Request $request, $id)
    {
        $user = User::find($id);
        if($user!=null){
            $user->delete();
        }
        return redirect()->route('adminUser');
    }
}
