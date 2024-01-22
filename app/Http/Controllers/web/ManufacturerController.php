<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Manufacturer;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;

class ManufacturerController extends Controller
{
    public static function getLogos()
    {
        $manufacturer = Manufacturer::where('active', 1)->take(6)->get()->toArray();
        return $manufacturer;
    }
    public function getProductManufacturer($id)
    {
        $product = Product::where('id_manufacturer', $id)->where('active', 1)->paginate(6);
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
        $manufacturer = Manufacturer::find($id);
        return view('web.pages.manufacturer')->with([
            'product'=>$product,
            'manufacturer'=>$manufacturer,
        ]);
    }
}
