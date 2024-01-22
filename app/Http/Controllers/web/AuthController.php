<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Customer_wishlist;
use App\Models\CustomerCart;
use Gloudemans\Shoppingcart\Facades\Cart;
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

            $customer = Auth::guard('customer')->user();
            $this->mergeCartWithDatabase();
            return redirect()->route('index');
        }

        return redirect()->back()->with('status','Email hoặc mật khẩu không chính xác');
    }
    public function logout(Request $request)
    {
//        Cart::store(Auth::guard('customer')->user()->email);
        Auth::guard('customer')->logout();
        return redirect()->route('index');
    }
    private function mergeCartWithDatabase()
    {
        // Lấy giỏ hàng từ session
        $sessionCart = Cart::content();

        // Lấy giỏ hàng từ database của người dùng
        $userCart = Auth::guard('customer')->user()->cart;

        if ($userCart) {
            // Gộp giỏ hàng từ session và database
            $mergedCart = $this->mergeCarts($sessionCart, $userCart->items);

            // Cập nhật giỏ hàng trong database
            $userCart->items = $mergedCart;
            $userCart->total_items = Cart::count();
            $totalPrice = str_replace(',', '', Cart::subtotal());
            $totalPrice = (float) $totalPrice;
            $userCart->total_price = $totalPrice;
            $userCart->save();

            Cart::destroy(); // Xóa giỏ hàng hiện tại

            // Thêm giỏ hàng đã gộp vào session
            foreach ($mergedCart as $item) {
                Cart::add([
                    'id' => $item['id'],
                    'name' => $item['name'],
                    'qty' => $item['qty'],
                    'price' => $item['price'],
                    'options' => $item['options'],
                ]);
            }
        }
    }
    private function mergeCarts($sessionCart, $databaseCart)
    {
        // Chuyển đổi dữ liệu giỏ hàng từ session và database thành mảng
        $sessionCartArray = $sessionCart->toArray();
        $databaseCartArray = $databaseCart;

        // Gộp mảng giỏ hàng từ session và database, tăng số lượng sản phẩm trùng
        $mergedCart = [];
        foreach ($sessionCartArray as $rowId => $sessionItem) {
            foreach ($databaseCartArray as $databaseItemId => $databaseItem) {
                if ($sessionItem['id'] === $databaseItem['id']) {
                    // Tăng số lượng sản phẩm trùng
                    $mergedCart[$rowId] = $sessionItem;
                    $mergedCart[$rowId]['qty'] += $databaseItem['qty'];
                    unset($databaseCartArray[$databaseItemId]);
                    break;
                }
            }
            if (!isset($mergedCart[$rowId])) {
                $mergedCart[$rowId] = $sessionItem;
            }
        }
        $mergedCart = array_merge($mergedCart, $databaseCartArray);

        return $mergedCart;
    }
}
