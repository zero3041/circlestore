<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Gloudemans\Shoppingcart\CartItem;
use Gloudemans\Shoppingcart\CartItemOptions;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function calculateTotalForEachProduct()
    {
        $cartItems = Cart::content();
        $totalForEachProduct = [];

        foreach ($cartItems as $item) {
            // Tính toán tổng tiền cho từng sản phẩm
            $totalPrice = $item->price * $item->qty;

            // Lưu tổng tiền vào mảng theo ID sản phẩm
            $totalForEachProduct[$item->id] = $totalPrice;
        }

        return $totalForEachProduct;
    }
    public function calculateGrandTotal()
    {
        $cartItems = Cart::content();
        $grandTotal = 0;

        foreach ($cartItems as $item) {
            // Tính toán tổng tiền của tất cả các sản phẩm trong giỏ hàng
            $grandTotal += $item->subtotal;
        }

        return $grandTotal;
    }
    public function index()
    {
        $cartItems = Cart::content();

        if (Auth::guard('customer')->check()) {
            // Nếu người dùng đã đăng nhập, lấy giỏ hàng từ database
            $userCart = Auth::guard('customer')->user()->cart; // Giả sử model User có phương thức cart

            if ($userCart) {
                // Gộp giỏ hàng từ session và giỏ hàng từ database
                $mergedCart = $this->mergeCarts($cartItems, $userCart->items);

                // Cập nhật giỏ hàng trong database
                $userCart->items = $mergedCart;
                $userCart->total_items = Cart::count();
                $totalPrice = str_replace(',', '', Cart::subtotal());
                $totalPrice = (float) $totalPrice;
                $userCart->total_price = $totalPrice;
//                dd($userCart);
                $userCart->save();

                Cart::destroy(); // Xóa giỏ hàng hiện tại
//                Cart::add($mergedCart); // Thêm giỏ hàng đã gộp
                foreach ($mergedCart as $item) {
                    Cart::add([
                        'id' => $item['id'],
                        'name' => $item['name'],
                        'qty' => $item['qty'],
                        'price' => $item['price'],
                        'options' => $item['options'],
                    ]);
                }

                // Sử dụng giỏ hàng gộp cho hiển thị
                $cartItems = $mergedCart;
            }
        }
//        dd($cartItems);
        $totalForEachProduct = $this->calculateTotalForEachProduct();
        $grandTotal = $this->calculateGrandTotal();
        $category = CategoryController::getMenuByname('laptop');
        return view('web.pages.cart',with([
            'cartItems' => $cartItems,
            'totalForEachProduct' =>$totalForEachProduct,
            'grandTotal' =>$grandTotal,
            'category' => $category
        ]));
    }
//    gop gio hang
    private function mergeCarts($sessionCart, $databaseCart)
    {
        // Chuyển đổi dữ liệu giỏ hàng từ session và database thành mảng
        $sessionCartArray = $sessionCart->toArray();
        $databaseCartArray = $databaseCart;

        // Gộp mảng giỏ hàng từ session và database
        $mergedCart = array_merge($sessionCartArray, $databaseCartArray);

        // Lặp qua mảng để kiểm tra và cập nhật số lượng nếu sản phẩm đã tồn tại
        foreach ($sessionCartArray as $sessionItem) {
            foreach ($databaseCartArray as &$dbItem) {
                if ($sessionItem['id'] == $dbItem['id']) {
                    $dbItem['qty'] += $sessionItem['qty'];
                }
            }
        }

        return $mergedCart;
    }
    public function addToCart($id)
    {
        $product = Product::find($id);
        $image = $product->images()->where('cover', 1)->first();

        if (!$product) {
            return response()->json(['status' => 'error', 'message' => 'Sản phẩm không tồn tại'], 404);
        }
        Cart::add([
            'id' => $product->id_product,
            'name' => $product->name,
            'qty' => 1,
            'price' => $product->price_sale,
            'options' => [
                'image' => $image['url'],
                'review' => $product->review,
            ],
        ]);
//        dd($product->price_sale);
        $cartItems = Cart::content();
        if (Auth::guard('customer')->check()) {
            $user = Auth::guard('customer')->user();
            $userCart = $user->cart()->firstOrNew();

            $userCart->items = $cartItems;
            $userCart->total_items = Cart::count();

            $totalPrice = str_replace(',', '', Cart::subtotal());
            $totalPrice = (float) $totalPrice;
            $userCart->total_price = $totalPrice;
            $userCart->save();
        }

        return response()->json(['status' => 'success', 'message' => 'Thêm thành công']);
    }
    public function removeFromCart($rowId)
    {
        Cart::remove($rowId);
        $cartItems = Cart::content();
        if (Auth::guard('customer')->check()) {
            $user = Auth::guard('customer')->user();
            $userCart = $user->cart()->firstOrNew();

            $userCart->items = $cartItems;
            $userCart->total_items = Cart::count();

            $totalPrice = str_replace(',', '', Cart::subtotal());
            $totalPrice = (float) $totalPrice;
            $userCart->total_price = $totalPrice;
            $userCart->save();
        }
        return redirect()->route('cart');
    }
    public function updateCart(Request $request)
    {
        $rowIds = $request->input('rowId');
        $qtys = $request->input('qty');

        foreach ($rowIds as $index => $rowId) {
            $qty = $qtys[$index];
            if ($qty == 0) {
                Cart::remove($rowId);
            } else {
                Cart::update($rowId, $qty);
            }
        }

        // Cập nhật giỏ hàng trong database (nếu có)


        return view('web.pages.cart');
    }

}
