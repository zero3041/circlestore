<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Manufacturer;
use App\Models\Product;
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
        $product = Product::where('id_manufacturer', $id)->where('active', 1)->paginate(20);
        foreach($product as $key => $value){
            $image = $value->images()->where('cover', 1)->first();
            $product[$key]['image'] = 'upload/product/home/'.$image['url'];
        }
        $manufacturer = Manufacturer::find($id);
        return view('front.pages.gridProduct')->with([
            'product'=>$product,
            'manufacturer'=>$manufacturer,
        ]);
    }
}
