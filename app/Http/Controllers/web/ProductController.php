<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public static function hotProduct()
    {
        $product = Product::where('hot', 1)->take(20)
            ->select('id_product', 'name', 'quantity', 'price_tax', 'price_sale', 'on_sale')->get();
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
        $product = $product->toArray();
        return $product;
    }
    public static function productTrend($number)
    {
        $product = Product::inRandomOrder()->where('hot', 1)->take($number)
            ->select('id_product', 'name', 'quantity', 'price_tax', 'price_sale', 'on_sale')->get();
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
        $product = $product->toArray();
        return $product;
    }
}
