<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $category = CategoryController::getMenuByname('laptop');
        return view('web.pages.cart',with([
            'category' => $category
        ]));
    }
}
