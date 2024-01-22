<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalOrders = DB::table('order')->count();

        // Tổng doanh thu
        $totalRevenue = DB::table('order')->sum('total_price_tax');

        // Số lượng sản phẩm phổ biến
        $popularProducts = DB::table('order_detail')
            ->select('id_product', 'product_name', DB::raw('SUM(product_quantity) as total_quantity'))
            ->groupBy('id_product', 'product_name')
            ->orderByDesc('total_quantity')
            ->limit(5)
            ->get();

        // Số lượng đơn hàng theo trạng thái
        $orderStatusCount = DB::table('order')
            ->select('status', DB::raw('COUNT(*) as count'))
            ->groupBy('status')
            ->get();
//        dd($orderStatusCount);
        foreach ($orderStatusCount as $key){
            switch($key->status){
                case 0: $key->status = 'Đã hủy'; break;
                case 1: $key->status = 'Chờ xác nhận'; break;
                case 2: $key->status = 'Đã xác nhận'; break;
                case 3: $key->status = 'Đang giao hàng'; break;
                case 4: $key->status = 'Giao hàng thành công'; break;
            }
        }

        $labels = $orderStatusCount->pluck('status')->toJson();
        $data = $orderStatusCount->pluck('count')->toJson();
        $totalCustomer = Customer::where('active',1)->count();
        $totalOrders = Order::count();
        $totalRevenue = Order::where('status', 1)->sum('total_price_tax');
        return view('admin.pages.dashboard',compact('totalOrders', 'totalRevenue','totalCustomer','totalOrders',
            'labels',
            'data',
            'totalRevenue',
            'popularProducts',
            'orderStatusCount'));
    }
}
