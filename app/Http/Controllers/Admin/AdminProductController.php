<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ImageController;
use App\Models\Category_product;
use App\Models\Feature;
use App\Models\Feature_product;
use App\Models\Feature_value;
use App\Models\Manufacturer;
use App\Models\Product;
use App\Models\Product_image;
use App\Models\Tax;
use Illuminate\Http\Request;

class AdminProductController extends Controller
{
    public function getProduct()
    {
        $product = Product::Paginate(10);
        // dd($product);
        if ($product != null) {
            foreach ($product as $key => $value) {
                if ($value['active'] == 1) {
                    $product[$key]['active'] = '<span class="badge bg-success">Hiển thị</span>';
                } else {
                    $product[$key]['active'] = '<span class="badge bg-danger">Đang ẩn</span>';
                }
                $image = $value->images()->where('cover', 1)->first();
                $product[$key]['image'] = $image['url'];

            }
        }
        return view('admin.pages.product')->with('product', $product);
    }

    public function searchProduct(Request $request)
    {
        if ($request->has('name')) {
            $key = $request->name;
            $product = Product::where('name', 'like', '%' . $request->name . '%')->paginate(10);
        } else {
            $product = Product::Paginate(10);
        }


        if ($product != null) {
            foreach ($product as $key => $value) {
                if ($value['active'] == 1) {
                    $product[$key]['active'] = '<span class="badge bg-success">Hiển thị</span>';
                } else {
                    $product[$key]['active'] = '<span class="badge bg-danger">Đang ẩn</span>';
                }
                $image = $value->images()->where('cover', 1)->first();
                $product[$key]['image'] = $image['url'];

            }
        }
        return view('admin.pages.product')->with('product', $product);
    }

    public function addProduct()
    {
        $tax = Tax::All();
        $manufacturer = Manufacturer::All();
        $feature = Feature::All();
        $feature_value = null;
        $manufacturer = Manufacturer::All();
        if ($tax != null) {
            $tax = $tax->toArray();
            foreach ($tax as $key => $value) {
                $tax[$key]['name'] = $value['name'] . ' (' . $value['value'] . '%)';
            }
        }
        if ($manufacturer != null) {
            $manufacturer = $manufacturer->toArray();
        }
        if ($feature != null) {
            $feature = $feature->toArray();
            $feature_value = Feature_value::where('id_feature', isset($feature[0]['id_feature']) ? $feature[0]['id_feature'] : 0)->get();
            if ($feature_value != null) {
                $feature_value = $feature_value->toArray();
            }
        }
        $category = AdminCategoryController::getProductCategory();
        return view('admin.pages.editProduct')->with([
            'category' => $category,
            'tax' => $tax,
            'manufacturer' => $manufacturer,
            'feature' => $feature,
            'feature_value' => $feature_value
        ]);
    }

    public function editProduct($id)
    {
        $product = Product::find($id);
        $feature = Feature::All();
        $manufacturer = Manufacturer::All();
        $tax = Tax::All();
        $feature_value = null;
        $feature_value_product = null;
        $feature_product = null;
        $category_product = null;
        $image = null;
        $total_feature = 0;
        if ($tax != null) {
            $tax = $tax->toArray();
            foreach ($tax as $key => $value) {
                $tax[$key]['name'] = $value['name'] . ' (' . $value['value'] . '%)';
            }
        }
        if ($product != null) {
            $product = $product->toArray();
            $category_product = Category_product::where('id_product', $product['id_product'])->select('id_category')->get()->toArray();
            $image = Product_image::where('id_product', $product['id_product'])->get()->toArray();
            $feature_product = Feature_product::where('id_product', $product['id_product'])->get()->toArray();
            $total_feature = count($feature_product);
        }
        if ($feature != null) {
            $feature = $feature->toArray();
            $feature_value = Feature_value::where('id_feature', isset($feature[0]['id_feature']) ? $feature[0]['id_feature'] : 0)->get();
            if ($feature_value != null) {
                $feature_value = $feature_value->toArray();
            }
            foreach ($feature_product as $key => $value) {
                $feature_value_product[$key] = Feature_value::where('id_feature', $value['id_feature'])->get();
                if ($feature_value_product[$key] != null) {
                    $feature_value_product[$key] = $feature_value_product[$key]->toArray();
                }
            }

        }
        foreach ($category_product as $key => $value) {
            $category_product[$key] = $value['id_category'];
        }
        $category = AdminCategoryController::getProductCategory();
        return view('admin.pages.editProduct')->with([
            'category' => $category,
            'category_product' => $category_product,
            'tax' => $tax,
            'manufacturer' => $manufacturer,
            'feature' => $feature,
            'feature_value' => $feature_value,
            'feature_value_product' => $feature_value_product,
            'feature_products' => $feature_product,
            'product' => $product,
            'image' => $image,
        ]);
    }

    public function postAddProduct(Request $request)
    {
        $request->validate([
            'name' => 'required|max:200',
            'cost' => 'required|numeric',
            'price' => 'required|numeric',
            'tax' => 'required|integer',
            'quantity' => 'required|integer|min:0',
            'percentPrice' => 'nullable|integer',
            'product_detail_short' => 'nullable',
            'product_detail' => 'nullable',
            'image' => 'required|array',
            'manufacturer' => 'required|integer',
//            'productParam' => 'required|array',
//            'productValue' => 'required|array',
            'category' => 'required|array',
            'active' => 'nullable|boolean',
            'sale' => 'nullable|boolean',
            'hotProduct' => 'nullable|boolean',
            'cover' => 'required|integer',
        ], [
            'name.required' => 'Vui lòng nhập tên thuộc tính',
            'cost.required' => 'Vui lòng nhập giá nhập sản phẩm',
            'price.required' => 'Vui lòng nhập giá sản phẩm',
            'cost.numeric' => 'Giá nhập sản phẩm phải là số',
            'price.numeric' => 'Giá sản phẩm phải là số',
            'tax.required' => 'Vui lòng chọn thuế',
            'tax.integer' => 'Thuế không đúng định dạng',
            'quantity.required' => 'Vui lòng chọn số lượng',
            'quantity.integer' => 'Số lượng phải là số nguyên',
            'quantity.min' => 'Số lượng phải lớn hơn hoặc bằng 0',
            'image.required' => 'Vui lòng chọn ảnh sản phẩm',
            'image.array' => 'Không đúng định dạng ảnh',
            'image.mimes' => 'Chỉ được phép tải ảnh dạng jpg, jpeg, png',
            'manufacturer.required' => 'Vui lòng chọn nhà sản xuất',
            'manufacturer.integer' => 'Nhà sản xuất không đúng định dạng',
//            'productParam.array' => 'Thông số sản phẩm không đúng định dạng',
//            'productValue.array' => 'Giá trị của thông số sản phẩm không đúng định dạng',
//            'productParam.required' => 'Vui lòng chọn thông số sản phẩm',
//            'productValue.required' => 'Vui lòng chọn giá trị cho thông số sản phẩm',
            'category.array' => 'Danh mục sản phẩm không đúng định dạng',
            'category.required' => 'Vui lòng chọn danh mục sản phẩm',
            'active.boolean' => 'Tình trạng sản phẩm không đúng định dạng',
            'sale.boolean' => 'Khuyến mãi không đúng định dạng',
            'hotProduct.boolean' => 'Sản phẩm nổi bật không đúng định dạng',
            'percentPrice.integer' => 'Phần trăm khuyến mãi phải là số nguyên',
            'cover.required' => 'Vui lòng chọn ảnh chính',
            'cover.integer' => 'Chọn ảnh chính không đúng định dạng',
        ]);
//        dd($request);

        $active = 1;
        if ($request->active != 1) {
            $active = 0;
        }
        $tax = Tax::find($request->tax);
        $tax_value = 0;
        $price_tax = $request->price;
        $price_sale = $price_tax;
        $hotProduct = 0;
        if ($request->hotProduct == 1) {
            $hotProduct = 1;
        }
        if ($tax != null) {
            $tax = $tax->toArray();
            $tax_value = (int)$tax['value'];
            $price_tax = $request->price + $request->price * ($tax_value / 100);
        }
        if ($request->sale == 1) {
            if ($request->percentPrice <= 100 && $request->percentPrice >= 0) {
                $price_sale = $price_tax - $price_tax * ($request->percentPrice / 100);
                $request->sale = $request->percentPrice;
            } else {
                $request->sale = 0;
            }

        } else {
            $request->sale = 0;
        }
        $product = new Product;
        $res = $product->create([
            'id_manufacturer' => $request->manufacturer,
            'cost' => $request->cost,
            'show_price' => 1,
            'on_sale' => $request->sale,
            'id_tax' => $request->tax,
            'active' => $active,
            'name' => $request->name,
            'description_short' => $request->product_detail_short,
            'description' => $request->product_detail,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'price_tax' => round($price_tax, 2),
            'price_sale' => $price_sale,
            'hot' => $hotProduct
        ]);
        $featureObj = new Feature_product;
        $feature_value = $request->productValue;
        if ($request->productParam)
        {
            foreach ($request->productParam as $key => $feature) {
                $featureObj->create([
                    'id_feature' => $feature,
                    'id_product' => $res->id_product,
                    'id_feature_value' => $feature_value[$key],
                ]);
            }
        }


        $categoryObj = new Category_product;
        foreach ($request->category as $key => $value) {
            $id_category_arr = explode('_', $value);
            $id_category = is_int((int)$id_category_arr[0]) ? $id_category_arr[0] : 0;
            $categoryObj->create([
                'id_category' => $id_category,
                'id_product' => $res->id_product,
                'position' => 1,
            ]);
        }

        $imageObj = new Product_image;
        $uploadPath = public_path('/upload/product');
        foreach ($request->image as $key => $photo) {
            $cover = 0;
            if ($key == $request->cover - 1) {
                $cover = 1;
            }
            $fileExtension = $photo->getClientOriginalExtension();
            $fileName = time() . "_" . rand(0, 9999999) . "_" . md5(rand(0, 9999999)) . "." . $fileExtension;
            ImageController::resizeImagePost($photo, $fileName, $uploadPath, 'product');
            $imageObj->create([
                'id_product' => $res->id_product,
                'cover' => $cover,
                'url' => $fileName,
            ]);

        }

        return redirect()->route('adminProduct');
    }
    public function postEditProduct(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:200',
            'cost' => 'required|numeric',
            'price' => 'required|numeric',
            'tax' => 'required|integer',
            'percentPrice' => 'nullable|integer',
            'quantity' => 'required|integer|min:0',
            'product_detail_short' => 'nullable',
            'product_detail' => 'nullable',
            'image' => 'array',
            'manufacturer' => 'required|integer',
            'productParam' => 'nullable|array',
            'productValue' => 'nullable|array',
            'category' => 'required|array',
            'active' => 'nullable|boolean',
            'cover' => 'required',
            'sale' => 'nullable|boolean',
            'hotProduct' => 'nullable|boolean',
        ], [
            'name.required' => 'Vui lòng nhập tên thuộc tính',
            'price.required' => 'Vui lòng nhập giá nhập sản phẩm',
            'cost.required' => 'Vui lòng nhập giá sản phẩm',
            'cost.numeric' => 'Giá nhập sản phẩm phải là số',
            'price.numeric' => 'Giá sản phẩm phải là số',
            'tax.required' => 'Vui lòng chọn thuế',
            'tax.integer' => 'Thuế không đúng định dạng',
            'quantity.required' => 'Vui lòng chọn số lượng',
            'quantity.integer' => 'Số lượng phải là số nguyên',
            'quantity.min' => 'Số lượng phải lớn hơn hoặc bằng 0',
            'image.array' => 'Không đúng định dạng ảnh',
            'image.mimes' => 'Chỉ được phép tải ảnh dạng jpg, jpeg, png',
            'manufacturer.required' => 'Vui lòng chọn nhà sản xuất',
            'manufacturer.integer' => 'Nhà sản xuất không đúng định dạng',
            'productParam.array' => 'Thông số sản phẩm không đúng định dạng',
            'productValue.array' => 'Giá trị của thông số sản phẩm không đúng định dạng',
            'category.array' => 'Danh mục sản phẩm không đúng định dạng',
            'category.required' => 'Vui lòng chọn danh mục sản phẩm',
            'active.boolean' => 'Tình trạng sản phẩm không đúng định dạng',
            'sale.boolean' => 'Khuyến mãi không đúng định dạng',
            'hotProduct.boolean' => 'Sản phẩm nổi bật không đúng định dạng',
            'percentPrice.integer' => 'Phần trăm khuyến mãi phải là số nguyên',
            'cover.required' => 'Vui lòng chọn ảnh chính',
        ]);

        $active = 1;
        if ($request->active != 1) {
            $active = 0;
        }
        $tax = Tax::find($request->tax);
        $tax_value = 0;
        $hotProduct = 0;
        if ($request->hotProduct == 1) {
            $hotProduct = 1;
        }
        $price_tax = $request->price;
        $price_sale = $price_tax;
        if ($tax != null) {
            $tax = $tax->toArray();
            $tax_value = (int)$tax['value'];
            $price_tax = $request->price + $request->price * ($tax_value / 100);
        }
        if ($request->sale == 1) {
            if ($request->percentPrice <= 100 && $request->percentPrice >= 0) {
                $price_sale = $price_tax - $price_tax * ($request->percentPrice / 100);
                $request->sale = $request->percentPrice;
            } else {
                $request->sale = 0;
            }

        } else {
            $request->sale = 0;
        }
        $product = Product::find($id);
        $request->quantity += $product->quantity;
        $product->update([
            'id_manufacturer' => $request->manufacturer,
            'show_price' => 1,
            'id_tax' => $request->tax,
            'on_sale' => $request->sale,
            'active' => $active,
            'name' => $request->name,
            'description_short' => $request->product_detail_short,
            'description' => $request->product_detail,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'price_tax' => round($price_tax, 2),
            'price_sale' => $price_sale,
            'hot' => $hotProduct
        ]);
        $featureObj = new Feature_product;
        $feature_value = $request->productValue;
        foreach ($request->productParam as $key => $feature) {
            $check = Feature_product::where('id_feature', $feature)->where('id_product', $id)->count();
            if ($check == 0) {
                $featureObj->create([
                    'id_feature' => $feature,
                    'id_product' => $id,
                    'id_feature_value' => $feature_value[$key],
                ]);
            } else {
                $featureObj::where('id_feature', $feature)->where('id_product', $id)->update([
                    'id_feature' => $feature,
                    'id_product' => $id,
                    'id_feature_value' => $feature_value[$key],
                ]);
            }

        }

        $categoryObj = new Category_product;//dd($request->category);
        foreach ($request->category as $key => $value) {
            $id_category = is_int((int)explode('_', $value)[0]) ? explode('_', $value)[0] : 0;
            $check = Category_product::where('id_category', $id_category)->where('id_product', $id)->count();
            if ($check == 0) {
                $res = $categoryObj->create([
                    'id_category' => $id_category,
                    'id_product' => $id,
                    'position' => 1,
                ]);
            } else {
                $categoryObj::where('id_category', $id_category)->where('id_product', $id)->update([
                    'id_category' => $id_category,
                    'id_product' => $id,
                    'position' => 1,
                ]);
            }

        }
    }
    public function deleteProduct(Request $request, $id)
    {
        $product = Product::find($id);
        if($product!=null){
            $product->delete();
            Category_product::where('id_product', $id)->delete();
            Feature_product::where('id_product', $id)->delete();
            $image = Product_image::where('id_product', $id)->select('url')->get()->toArray();
            foreach($image as $value){
                $image_path = public_path().'/upload/product/';
                if(file_exists($image_path.$value['url'])){
                    @unlink($image_path.$value['url']);
                    @unlink($image_path.'home/'.$value['url']);
                }
            }
            Product_image::where('id_product', $id)->delete();
        }
        return redirect()->route('adminProduct');
    }
    public function deleteImageProductAPI(Request $request)
    {
        $validator = Validator::make($request->input(), array(
            'id_image' => 'required',
            'id_image' => 'integer',
        ));
        if ($validator->fails()) {
            return response()->json([
                'error'    => true,
                'messages' => 'Dữ liệu không hợp lệ',
            ], 422);
        }
        $image = Product_image::find($request->id_image);
        if($image != null){
            $check_cover = Product_image::where('cover', 1)->where('id_image',$request->id_image)->first();
            if($check_cover != null){
                return response()->json(['error' => true, 'messages' => 'Không thể xóa ảnh chính của sản phẩm']);
            }
            $image_path = public_path().'/upload/product/';
            if(file_exists($image_path.$image->url)){
                @unlink($image_path.$image->url);
                @unlink($image_path.'home/'.$image->url);
            }
            Product_image::where('id_image', $request->id_image)->delete();
            return response()->json(['error' => false, 'messages' => 'Xoá ảnh thành công']);
        }
        return response()->json(['error' => true, 'messages' => 'Lỗi khi xóa hình ảnh']);
    }
    public function deleteFeatureProductAPI(Request $request)
    {
        $validator = Validator::make($request->input(), array(
            'id_feature' => 'required',
            'id_feature' => 'integer',
            'id_product' => 'required',
            'id_product' => 'integer',
        ));
        if ($validator->fails()) {
            return response()->json([
                'error'    => true,
                'messages' => 'Dữ liệu không hợp lệ',
            ], 422);
        }
        $feature_product = Feature_product::where('id_feature', $request->id_feature)
            ->where('id_product',$request->id_product)->first();
        if($feature_product != null){
            Feature_product::where('id_feature', $request->id_feature)
                ->where('id_product',$request->id_product)->delete();
            return response()->json(['error' => false, 'messages' => 'Xoá thông số sản phẩm thành công']);
        }
        return response()->json(['error' => true, 'messages' => 'Lỗi khi xóa thông số sản phẩm']);
    }
}
