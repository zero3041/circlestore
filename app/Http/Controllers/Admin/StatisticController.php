<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatisticController extends Controller
{
    public function orderStatistics()
    {
        // Thống kê số lượng đơn hàng, tổng doanh thu, sản phẩm phổ biến, v.v.

        // Số lượng đơn hàng
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

        // Bạn có thể thêm các thống kê khác tùy thuộc vào nhu cầu của bạn

        // Trả về dữ liệu thống kê
        return view('admin.pages.orderStatistics', compact('totalOrders',
                                                                'labels',
                                                                        'data',
                                                                        'totalRevenue',
                                                                        'popularProducts',
                                                                        'orderStatusCount'));
    }
}
