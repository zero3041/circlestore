<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\FlashSale;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;

class FlashSaleController extends Controller
{
    public function index()
    {
        $flash = FlashSale::all();
//        dd($flash);
        return view('admin.pages.flashsale',compact('flash'));
    }
    public function add()
    {
        $products = Product::all();
        return view('admin.pages.editFlashSale',compact('products'));
    }
    public function postAddAdminVoucher(Request $request)
    {
        $request->validate([
            'discount_price' => 'required|numeric',
            'end_date' => 'required|date',
            'id_product' => 'required|numeric',
        ]);

        $product = Product::findOrFail($request->id_product);

        // Tạo hoặc cập nhật thông tin giảm giá
        $discount = FlashSale::updateOrCreate(
            ['product_id' => $request->id_product],
            [
                'discount_price' => $request->discount_price,
                'end_date' => $request->end_date,
            ]
        );

        // Cập nhật giá của sản phẩm trong bảng products
        $product->update(['price' => $request->discount_price]);

        return view('admin.pages.flashsale');
    }
    public static function send()
    {
        $flashSaleProductsInDiscount = FlashSale::inRandomOrder()->where('end_date', '>', now())->take(1)->get();
//        dd($flashSaleProductsInDiscount);
        $flashSaleProducts = new Product();
        $time ='';
        foreach ($flashSaleProductsInDiscount as $discount) {
            $flashSaleProducts = Product::where('id_product', $discount->product_id)->get();
            $time = $discount->end_date;
        }
        foreach($flashSaleProducts as $key => $value){
            $image = $value->images()->where('cover', 1)->first();
            $flashSaleProducts[$key]['image'] = 'upload/product/home/'.$image['url'];
            $flashSaleProducts[$key]['time'] = $time;
            $totalReview = (int)Review::where('id_product', $value->id_product)->count();
            if($totalReview == 0){
                $flashSaleProducts[$key]['review'] = 0;
            }else{
                $flashSaleProducts[$key]['review'] = ((int)Review::where('id_product', $value->id_product)->sum('vote') / $totalReview) * 20;
            }
        }
        return $flashSaleProducts;
    }
}
