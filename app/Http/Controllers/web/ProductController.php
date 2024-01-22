<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Feature;
use App\Models\Feature_product;
use App\Models\Feature_value;
use App\Models\Manufacturer;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public static function hotProduct()
    {
        $product = Product::inRandomOrder()->take(12)
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
    public function productDetail($id)
    {
        $category = CategoryController::getMenuByname('laptop');
        $product = Product::find($id);
        $manufacturer = null;
        $feature = null;
        if($product != null){
            $manufacturer = Manufacturer::find($product->id_manufacturer);
            $feature = Feature_product::where('id_product', $id)->get()->toArray();
            foreach($feature as $key=>$value){
                $featureName = Feature::find($value['id_feature']);
                $feature[$key]['name'] = $featureName['name'];
                $featureValue = Feature_value::find($value['id_feature_value']);
                $feature[$key]['value'] = $featureValue['value'];
            }
            $image = $product->images()->select('url','cover')->get()->toArray();
            foreach($image as $key=>$value){
                $image[$key]['url'] = $value['url'];
            }
            $product['image'] = $image;
            $product = $product->toArray();
            $totalReview = (int)Review::where('id_product', $id)->count();
            if($totalReview == 0){
                $product['review'] = 0;
            }else{
                $product['review'] = ((int)Review::where('id_product', $id)->sum('vote') / $totalReview) * 20;
            }
            $product['totalReview'] = $totalReview;
            $review = Review::where('id_product', $id)->get();
            foreach($review as $key => $value){
                $review[$key]->id_customer = Customer::find($value->id_customer)->name;
            }
        }else{
            return redirect()->route('index');
        }
        return view('web.pages.productDetail')->with([
            'product'=>$product,
            'feature' => $feature,
            'manufacturer' => $manufacturer,
            'review' => $review,
            'category' => $category
        ]);
    }
}
