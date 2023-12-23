<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public static function getMenuByname($namecategory)
    {
        $category = Category::where('active', 1)->where('name',$namecategory)->where('level', 1)->select('id_category', 'name')->get()->toArray();
        foreach($category as $key=> $value){
            $category[$key]['level2'] = Category::where('active', 1)->where('level', 2)->where('id_parent', $value['id_category'])->select('id_category', 'name')->get()->toArray();
            foreach($category[$key]['level2'] as $key1 => $value1){
                $category[$key]['level2'][$key1]['level3'] = Category::where('active', 1)->where('level', 3)->where('id_parent', $value1['id_category'])->select('id_category', 'name')->get()->toArray();
            }
        }
        return $category;
    }
}
