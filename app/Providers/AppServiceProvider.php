<?php

namespace App\Providers;

use App\Http\Controllers\web\CartController;
use App\Http\Controllers\web\CategoryController;
use App\Http\Controllers\web\ManufacturerController;
use App\Models\Configuration;
use App\Models\Customer_wishlist;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        session_start();
        Auth::check();
        $menus = CategoryController::getMenu();
        $manufacturer = ManufacturerController::getLogos();
        $shop = Configuration::all();
        $shopValue = array();
        foreach($shop as $value){
            switch($value->name){
                case 'LOGO': $shopValue['logo'] = $value->value; break;
                case 'SHOP_NAME': $shopValue['shopName'] = $value->value; break;
                case 'ADDRESS': $shopValue['address'] = $value->value; break;
                case 'PHONE': $shopValue['phone'] = $value->value; break;
                case 'EMAIL': $shopValue['email'] = $value->value; break;
            }
        }
        View::share([
            'menus'=> $menus,
            'manufacturers' => $manufacturer,
            'shopValue' => $shopValue,
        ]);
    }
}
