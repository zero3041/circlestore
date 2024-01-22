<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Mail\sensMailInvoice;
use App\Models\Carrier;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Order_detail;
use App\Models\Product;
use App\Models\Product_image;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\web\PaymentController;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function getOrder($id_customer, $paginate = false)
    {
        if(!$paginate){
            $order = Order::where('id_customer', $id_customer)->orderBy('id_order', 'desc')->take(3)->get()->toArray();
        }else{
            $order = Order::where('id_customer', $id_customer)->orderBy('id_order', 'desc')->paginate($paginate);
        }

        foreach($order as $key => $value){
            switch($value['status']){
                case 0: $order[$key]['status'] = 'Đã hủy'; break;
                case 1: $order[$key]['status'] = 'Chờ xác nhận'; break;
                case 2: $order[$key]['status'] = 'Đã xác nhận'; break;
                case 3: $order[$key]['status'] = 'Đang giao hàng'; break;
                case 4: $order[$key]['status'] = 'Giao hàng thành công'; break;
            }
        }
        return $order;
    }
    public function handleCallback(Request $request)
    {
        // Lấy thông tin từ callback URL
        $vnp_ResponseCode = $request->input('vnp_ResponseCode');
        $vnp_TxnRef = $request->input('vnp_TxnRef');
        $vnp_BankTranNo = $request->input('vnp_BankTranNo');
        // Kiểm tra xem thanh toán có thành công không
        if ($vnp_ResponseCode == '00') {
            // Thanh toán thành công, cập nhật trạng thái đơn hàng trong CSDL
            $this->updateOrderStatus($vnp_TxnRef, 2,$vnp_BankTranNo);
        } else {
            // Thanh toán không thành công
            $this->updateOrderStatus($vnp_TxnRef, 0,$vnp_BankTranNo);
        }

        // Hiển thị trang thông báo cho người dùng

    }
    private function updateOrderStatus($orderId, $status, $tracking)
    {
        // Xử lý cập nhật trạng thái đơn hàng trong CSDL
        Order::where('id_order', $orderId)->update(['check' => $status,'tracking_number'=>$tracking]);
    }
    public function orderCustomer(Request $request)
    {
        $this->handleCallback($request);
        $customer = Auth::guard('customer')->user()->toArray();
        $order = $this->getOrder($customer['id_customer'], 10);
        return view('web.pages.order')->with(['customer'=>$customer,'setActive'=>3, 'order'=> $order]);
    }
    public function checkOut()
    {
        if(Cart::count()<=0) {
            return redirect()->route('index');
        }
        $carrier = Carrier::where('active', 1)->get();
        $customer = Customer::find(Auth::guard('customer')->user()->id_customer);
        return view('web.pages.checkout')->with([
            'carrier' => $carrier,
            'customer' => $customer,
        ]);
    }
    public function order(Request $request)
    {
        $request->validate([
            'phone_number' => 'required|numeric',
            'carrier' => 'required|integer',
            'payment' => 'required|integer',
        ],[
            'phone_number.numeric' => 'Số điện thoại phải là chữ số',
            'phone_number.required' => 'Vui lòng nhập số điện thoại',
            'carrier.integer' => 'Nhà vận chuyển không đúng định dạng',
            'carrier.required' => 'Vui lòng chọn nhà vận chuyển',
            'payment.integer' => 'Phương thức thanh toán không đúng định dạng',
            'payment.required' => 'Vui lòng chọn phương thức thanh toán',
        ]);
        $address = $request->address3 .', '. $request->address2 .', '. $request->address1 .', '. $request->city;

        foreach (Cart::content() as $value)
        {
            $product = Product::find($value->id);
            if($product->quantity===0)
            {
                return redirect()->route('checkout')
                    ->withErrors(['quantity_product'=>'Sản phẩm '.$value->name.' trong kho đã hết. Bạn vui lòng chọn sản phẩm khác.']);
            }elseif ($value->qty > $product->quantity)
            {
                return redirect()->route('checkout')
                    ->withErrors(['quantity_product'=>'Sản phẩm '.$value->name.' trong kho không đủ số lượng.']);
            }
            else
            {
                $product->quantity -= $value->qty;
                $product->save();
            }
        }
        $carrier = Carrier::find($request->carrier);
        $totalPrice = Cart::total();
        $order = new Order();
        $res = $order->create([
            'id_carrier' => $request->carrier,
            'id_customer' => Auth::guard('customer')->user()->id_customer,
            'payment' => $request->payment,
            'total_discount' => 0,
            'total_shipping' => $carrier->price,
            'total_price' => ($totalPrice-$carrier->price),
            'total_tax' => $totalPrice,
            'total_price_tax' => $totalPrice,
            'phone_number' => $request->phone_number,
            'address' => $address,
            'status' => 1,
            'check' => 1,
        ]);
        foreach(Cart::content() as $value){
            $order_detail = new Order_detail;
            $order_detail->id_order = $res->id_order;
            $order_detail->id_product = $value->id;
            $order_detail->id_product_attribute = 0;
            $order_detail->product_quantity = $value->qty;
            $order_detail->product_name = $value->name;
            $order_detail->save();
        }
        if($request->payment == 1)
        {
            $amount = ($totalPrice-$carrier->price); // Chuyển đổi sang đơn vị đồng
            $order_code = $res->id_order;
            $url = new PaymentController();
            $urlVNPay = $url->vnpay_payment($order_code,$amount);
            return redirect($urlVNPay);
        }
        else
        {
            $customer = Customer::find($res->id_customer);
            Mail::to($customer->email)->send(new sensMailInvoice($customer, $res));
        }
        return  redirect()->route('orderCustomer');
    }

    public function orderDetail($id)
    {
        $customer = Auth::guard('customer')->user()->toArray();
        $order = Order::find($id);
        $orderDetail = null;
        if($order!=null){
            $carrier = Carrier::find($order->id_carrier);
            $order->id_carrier = $carrier->name;
            $orderDetail = Order_detail::where('id_order', $id)->get();
            foreach($orderDetail as $key => $value){
                $image = Product_image::where('cover', 1)->where('id_product', $value->id_product)->first();
                $product = Product::find($value->id_product);
                $orderDetail[$key]->image = $image->url;
                $orderDetail[$key]->price = $product->price_sale;
                $orderDetail[$key]->total_price_product = $product->price_sale * $value->product_quantity;
            }
        }
        switch($order->payment){
            case 0: $order->payment = 'Thanh toán khi nhận hàng'; break;
            case 1: $order->payment = 'Thanh toán online'; break;
            case 2: $order->payment = 'Qua thẻ ATM'; break;
        }
        switch($order->check){
            case 0: $order->check = 'Chưa thanh toán'; break;
            case 1: $order->check = 'Chờ thanh toán'; break;
            case 2: $order->check = 'Đã thanh toán'; break;
        }
        switch($order->status){
            case 0: $order->status = 'Đã hủy'; break;
            case 1: $order->status = 'Chờ xác nhận'; break;
            case 2: $order->status = 'Đã xác nhận'; break;
            case 3: $order->status = 'Đang giao hàng'; break;
            case 4: $order->status = 'Giao hàng thành công'; break;
        }
        return view('web.pages.orderDetail')->with([
            'customer'=>$customer,
            'setActive'=>3,
            'order' => $order,
            'orderDetail' => $orderDetail,
        ]);
    }
}
