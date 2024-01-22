<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\admin\FlashSaleController;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Review;
use App\Models\Slide;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;


class LayoutController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');

        $product = Product::where('name', 'LIKE', "%$query%")
            ->orWhere('description', 'LIKE', "%$query%")->paginate(20);

        foreach($product as $key => $value){
            $image = $value->images()->where('cover', 1)->first();
            $product[$key]['image'] = 'upload/product/home/'.$image['url'];
            $totalReview = (int)Review::where('id_product', $value->id_product)->count();
            if($totalReview == 0){
                $product[$key]['review'] = 0;
            }else{
                $product[$key]['review'] = ((int)Review::where('id_product', $value->id_product)->sum('vote') / $totalReview) * 20;
            }
        }
        return view('web.pages.search',compact('product'));
    }
    public function index()
    {

        $hotProduct = ProductController::hotProduct();
        $productTrend = ProductController::productTrend(8);
        $trendCol1 = array_slice($productTrend, 0, 4);
        $trendCol2 = array_slice($productTrend, 4, 4);
        $manufacturer = ManufacturerController::getLogos();
        $flashsale = FlashsaleController::send()->toArray();

        $category = CategoryController::getMenuByname('laptop');

        $slider = Slide::all()->where('active',1);
        return view('web.pages.index',
            with([
                'hotProduct' => $hotProduct,
                'slider' => $slider,
                'category' => $category,
                'trendCol1' => $trendCol1,
                'trendCol2' => $trendCol2,
                'manufacturer' => $manufacturer,
                'sale' => $flashsale
            ])
        );
    }
}
