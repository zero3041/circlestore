<?php

namespace App\Http\Controllers;

use App\Models\Carrier;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Order_detail;
use App\Models\Product;
use App\Models\Product_image;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\PDF;

class PDFController extends Controller
{
    public function index($id)
    {
        $orderDetail = null;
        $order = Order::find($id);
        if($order!=null)
        {
            $order['id_customer'] = Customer::find($order['id_customer'])->name;
            $orderDetail = Order_detail::where('id_order', $id)->get();

            $carrier = Carrier::find($order->id_carrier);
            $order->id_carrier = $carrier->name;
            foreach($orderDetail as $key => $value){
                $image = Product_image::where('cover', 1)->where('id_product', $value->id_product)->first();
                $product = Product::find($value->id_product);
                $orderDetail[$key]->image = $image->url;
                $orderDetail[$key]->price = $product->price_sale;
                $orderDetail[$key]->quantity = $product->quantity;
                $orderDetail[$key]->total_price_product = $product->price_sale * $value->product_quantity;
            }
        }

        $data = [$order,$orderDetail];
        return view('invoice')->with(['data'=>$data, 'orderDetail' => $orderDetail]);
        $pdf = PDF::loadView('invoice', compact('data'));
        return $pdf->download('invoice.pdf');
    }
}
