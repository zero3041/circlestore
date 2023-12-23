<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Slide;
use Illuminate\Http\Request;

class LayoutController extends Controller
{
    public function index()
    {
        $hotProduct = ProductController::hotProduct();
        $productTrend = ProductController::productTrend(8);
        $trendCol1 = array_slice($productTrend, 0, 4);
        $trendCol2 = array_slice($productTrend, 4, 4);
        $manufacturer = ManufacturerController::getLogos();

        $category = CategoryController::getMenuByname('laptop');

        $slider = Slide::all()->where('active',1);
        return view('web.pages.index',
            with([
                'hotProduct' => $hotProduct,
                'slider' => $slider,
                'category' => $category,
                'trendCol1' => $trendCol1,
                'trendCol2' => $trendCol2,
                'manufacturer' => $manufacturer
            ])
        );
    }
}
