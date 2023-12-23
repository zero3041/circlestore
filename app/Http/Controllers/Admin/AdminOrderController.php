<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Carrier;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Order_detail;
use App\Models\Product;
use App\Models\Product_image;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function getOrder()
    {
        $order = Order::orderBy('id_order', 'desc')->Paginate(10);
        foreach ($order as $key => $value) {
            $order[$key]['id_customer'] = Customer::find($value['id_customer'])->name;
            switch ($value['payment']) {
                case 0:
                    $order[$key]['payment'] = '<p class="text-success">Nhận hàng thanh toán</p>';
                    break;
                case 1:
                    $order[$key]['payment'] = '<p class="text-primary">Thanh toán online</p>';
                    break;
                case 2:
                    $order[$key]['payment'] = '<p class="text-warning">Qua thẻ ATM</p>';
                    break;
            }
            switch ($value['check']) {
                case 0:
                    $order[$key]['check'] = '<p class="badge bg-danger">Chưa thanh toán</p>';
                    break;
                case 1:
                    $order[$key]['check'] = '<p class="badge bg-warning">Chờ thanh toán</p>';
                    break;
                case 2:
                    $order[$key]['check'] = '<p class="badge bg-success">Đã thanh toán</p>';
                    break;
            }
            switch ($value['status']) {
                case 0:
                    $order[$key]['status'] = '<p class="badge bg-dark">Đã hủy</p>';
                    break;
                case 1:
                    $order[$key]['status'] = '<p class="badge bg-danger">Chờ xác nhận</p>';
                    break;
                case 2:
                    $order[$key]['status'] = '<p class="badge bg-info">Đã xác nhận</p>';
                    break;
                case 3:
                    $order[$key]['status'] = '<p class="badge bg-warning">Đang giao hàng</p>';
                    break;
                case 4:
                    $order[$key]['status'] = '<p class="badge bg-success">Giao hàng thành công</p>';
                    break;
            }
        }
        return view('admin.pages.order')->with('order', $order);
    }

    public function editOrder($id)
    {
        $order = Order::find($id);
        $orderDetail = Order_detail::where('id_order', $id)->get();
        $customer = Customer::find($order->id_customer);
        $order->id_customer = $customer->name;
        $carrier = Carrier::find($order->id_carrier);
        $order->id_carrier = $carrier->name;
        foreach ($orderDetail as $key => $value) {
            $image = Product_image::where('cover', 1)->where('id_product', $value->id_product)->first();
            $product = Product::find($value->id_product);
            $orderDetail[$key]->image = $image->url;
            $orderDetail[$key]->price = $product->price_sale;
            $orderDetail[$key]->quantity = $product->quantity;
            $orderDetail[$key]->total_price_product = $product->price_sale * $value->product_quantity;
        }

        return view('admin.pages.orderDetail')->with(['order' => $order, 'orderDetail' => $orderDetail]);
    }

    public function postEditOrder(Request $request, $id)
    {
        $request->validate([
            'address' => 'required|max:255',
            'phone' => 'required|numeric',
            'check' => 'required|integer',
            'payment' => 'required|integer',
            'status' => 'required|integer',
            'tracking_number' => 'nullable|max:255',
            'product_quantity' => 'required|array',
            'product' => 'required|array'
        ], [
            'address.required' => 'Vui lòng nhập địa chỉ',
            'address.max' => 'Địa chỉ không quá 255 ký tự',
            'phone.required' => 'Vui lòng nhập số điện thoại',
            'phone.numeric' => 'Số điện thoại không đúng định dạng',
            'check.required' => 'Vui lòng chọn trạng thái thanh toán',
            'check.integer' => 'Trạng thái thanh toán không đúng định dạng',
            'payment.required' => 'Vui lòng chọn phương thức thanh toán',
            'payment.integer' => 'Phương thức thanh toán không đúng định dạng',
            'status.required' => 'Vui lòng chọn trạng thái đơn hàng',
            'status.integer' => 'Trạng thái đơn hàng không đúng định dạng',
            'tracking_number.max' => 'Mã vận chuyển không quá 255 ký tự',
            'product_quantity.required' => 'Vui lòng nhập số lượng mua',
            'product_quantity.array' => 'Số lượng mua không đúng định dạng',
            'product.required' => 'Không có sản phẩm nào trong đơn hàng',
            'product.array' => 'Sản phẩm không đúng định dạng',
        ]);
        $order = Order::find($id);
        if ($order != null) {
            $order->phone_number = $request->phone;
            $order->address = $request->address;
            $order->tracking_number = $request->tracking_number;
            switch ($request->check) {
                case 0:
                    $order->check = 0;
                    break;
                case 1:
                    $order->check = 1;
                    break;
                case 2:
                    $order->check = 2;
                    break;
                default:
                    $order->check = 0;
            }
            switch ($request->payment) {
                case 0:
                    $order->payment = 0;
                    break;
                case 1:
                    $order->payment = 1;
                    break;
                case 2:
                    $order->payment = 2;
                    break;
                default:
                    $order->payment = 0;
            }
            switch ($request->status) {
                case 0:
                    $order->status = 0;
                    $orderDetail = Order_detail::where('id_order', $id)->get();
                    foreach ($orderDetail as $key => $value) {
                        $quantity = $value->product_quantity;
                        $product = Product::find($value->id_product);
                        $product->quantity += $quantity;
                        $product->save();
                    }
                    $order->save();
                    return redirect()->route('editOrder', ['id' => $id])->with('status', 'Cập nhật thông tin thành công. Đã hủy đơn hàng và chuyển sản phẩm đã mua về kho.');
                    break;
                case 1:
                    $order->status = 1;
                    break;
                case 2:
                    $order->status = 2;
                    break;
                case 3:
                    $order->status = 3;
                    break;
                case 4:
                    $order->status = 4;
                    break;
                default:
                    $order->status = 0;
            }
            $total = $order->total_price_tax;
            $totalPrice_tax = 0;

            foreach ($request->product_quantity as $key => $value) {
                if (!is_int((int)$value) || $value <= 0) {
                    return redirect()->route('editOrder', ['id' => $id])
                        ->withErrors(['quantity' => 'Số lượng sản phẩm phải là số lớn hơn 0']);
                }

            }
            $orderDetail = Order_detail::where('id_order', $id)->get();
            foreach ($orderDetail as $key => $value) {
                $qty = $request->product_quantity[$key];
                if ($qty < $value->product_quantity) {
                    $qty = $value->product_quantity - $qty;
                    $product = Product::where('id_product', $value->id_product)->first();
                    $product->quantity += $qty;
                    $totalPrice_tax += $product->price_sale * $request->product_quantity[$key];
                    $product->save();

                } else {
                    $qty = $qty - $value->product_quantity;
                    $product = Product::where('id_product', $value->id_product)->where('quantity', '>=', $qty)->first();
                    if ($product != null) {
                        $product->quantity -= $qty;
                        $totalPrice_tax += $product->price_sale * $request->product_quantity[$key];
                        $product->save();
                    } else {
                        return redirect()->route('editOrder', ['id' => $id])
                            ->withErrors(['quantity_product' => 'Sản phẩm có ID là ' . $value->id_product . ' trong kho không đủ số lượng.']);
                    }
                }
                Order_detail::find($value->id_order_detail)->update(['product_quantity' => $request->product_quantity[$key]]);

            }
            $carrier = Carrier::find($order->id_carrier);
            $totalPrice = $totalPrice_tax;
            $totalPrice_tax += $carrier->price;
            $order->total_price = $totalPrice;
            $order->total_price_tax = $totalPrice_tax;
            $order->save();

        }

        return redirect()->route('editOrder', ['id' => $id])->with('status', 'Cập nhật thông tin thành công');
    }

    public function deleteOrder(Request $request, $id)
    {
        $order = Order::find($id);
        if ($order != null) {
            $order->delete();
            Order_detail::where('id_order', $id)->delete();
        }
        return redirect()->route('adminOrder');
    }
}
