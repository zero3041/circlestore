<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Category_product;
use App\Models\Product;
use App\Models\Review;
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
    public static function getMenu()
    {
        $category = Category::where('active', 1)->where('level', 1)->select('id_category', 'name')->get()->toArray();
        foreach($category as $key=> $value){
            $category[$key]['level2'] = Category::where('active', 1)->where('level', 2)->where('id_parent', $value['id_category'])->select('id_category', 'name')->get()->toArray();
            foreach($category[$key]['level2'] as $key1 => $value1){
                $category[$key]['level2'][$key1]['level3'] = Category::where('active', 1)->where('level', 3)->where('id_parent', $value1['id_category'])->select('id_category', 'name')->get()->toArray();
            }
        }
        return $category;
    }
    public function getProductCategory($id)
    {
        $productCategory = Category_product::where('id_category', $id)->get();
        $id_product = [];
        foreach($productCategory as $key => $value){
            $id_product[] = $value['id_product'];
        }
        $category = Category::find($id);
        $product = Product::whereIn('id_product', $id_product)->paginate(6);
//        dd($product);
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
        return view('web.pages.category')->with([
            'product'=>$product,
            'category'=>$category,
        ]);
    }
    public function sortCategory($id, $sortType)
    {
        $category = Category::find($id);

        // Lấy danh sách sản phẩm theo id và sắp xếp theo yêu cầu
        $products = $this->getSortedProducts($id, $sortType);

        // Trả về view hoặc JSON tùy thuộc vào yêu cầu của bạn
        return view('web.pages.category')->with([
            'product' => $products,
            'category' => $category,
        ]);
    }

    private function getSortedProducts($id, $sortType)
    {
        $productCategory = Category_product::where('id_category', $id)->get();
        $id_product = [];
        foreach ($productCategory as $key => $value) {
            $id_product[] = $value['id_product'];
        }

        // Thực hiện truy vấn để lấy danh sách sản phẩm theo id và sắp xếp theo yêu cầu
        $query = Product::whereIn('id_product', $id_product);

        switch ($sortType) {
            case 'name':
                $query->orderBy('name', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price_sale', 'desc');
                break;
            case 'price_asc':
                $query->orderBy('price_sale', 'asc');
                break;
            // Thêm các trường hợp sắp xếp khác nếu cần
            default:
                // Mặc định sắp xếp theo id hoặc theo điều kiện khác
                $query->orderBy('id', 'asc');
                break;
        }

        $products = $query->paginate(6);

        // Thêm các thông tin khác vào mỗi sản phẩm
        foreach ($products as $key => $value) {
            $image = $value->images()->where('cover', 1)->first();
            $products[$key]['image'] = 'upload/product/home/' . $image['url'];
            $totalReview = (int)Review::where('id_product', $value->id_product)->count();
            if ($totalReview == 0) {
                $products[$key]['review'] = 0;
            } else {
                $products[$key]['review'] = ((int)Review::where('id_product', $value->id_product)->sum('vote') / $totalReview) * 20;
            }
        }

        return $products;
    }
}
