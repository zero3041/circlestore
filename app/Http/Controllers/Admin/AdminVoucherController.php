<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category_product;
use App\Models\Category_voucher;
use App\Models\Product;
use App\Models\Voucher;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Admin\AdminCategoryController;

class AdminVoucherController extends Controller
{
    public function index()
    {
        $voucher = Voucher::all();
        return view('admin.pages.voucher',compact('voucher'));
    }
    public function add()
    {

        $category = AdminCategoryController::getProductCategory();
        return view('admin.pages.editVoucher')->with([
            'category'=> $category,
        ]);
    }
    public function postAddAdminVoucher(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'code' => 'required|unique:vouchers',
            'discount' => 'required|numeric|min:0|max:100',
            'condition' => 'nullable',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'quantity' => 'nullable|integer|min:1',
            'category' => 'required|array',
            [
                'category.array' => 'Danh mục sản phẩm không đúng định dạng',
                'category.required' => 'Vui lòng chọn danh mục sản phẩm',
            ]
        ]);
        $voucher = new Voucher;
        $res = $voucher->create([
            'name' => $request->name,
            'code' => $request->code,
            'discount' => $request->discount,
            'condition' => $request->condition,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'quantity' => $request->quantity,
        ]);
        $categoryObj = new Category_voucher;
        foreach ($request->category as $key => $value) {
            $id_category_arr = explode('_', $value);
            $id_category = is_int((int)$id_category_arr[0]) ? $id_category_arr[0] : 0;
            $categoryObj->create([
                'voucher_id' => $res->id,
                'category_id' => $id_category,
                'position' => 1,
            ]);
        }
        return redirect()->route('AdminVoucher');
    }
    public function applyDiscount(Request $request)
    {
        $voucherCode = $request->input('voucher_code');

        $voucher = Voucher::where('code', $voucherCode)
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->first();

        if ($voucher) {
            $categories = Category_voucher::where('voucher_id', $voucher->id)->pluck('category_id')->toArray();

            foreach (Cart::content() as $item) {
                $productId = $item->id;

                // Lấy danh sách danh mục của sản phẩm từ bảng pivot
                $productCategories = DB::table('category_product')
                    ->where('id_product', $productId)
                    ->pluck('id_category')
                    ->toArray();

                if (count(array_intersect($productCategories, $categories)) > 0) {
                    $options = $item->options;

                    // Lưu giá ban đầu của sản phẩm nếu chưa được lưu
                    if (!isset($options['original_price'])) {
                        $options['original_price'] = $item->price;
                    }

                    // Kiểm tra nếu đã sử dụng mã này trước đó
                    if (isset($options['voucher_applied']) && $options['voucher_applied'] ===true) {
                        return response()->json(['success' => false, 'message' => 'Bạn phải huỷ mã cũ để áp dụng mã mới']);
                    }

                    $discountedPrice = $item->price - ($item->price * ($voucher->discount / 100));

                    // Thêm thông tin vào options
                    $options['voucher_applied'] = true;
                    $options['applied_voucher_code'] = $voucherCode.'('.$voucher->discount.'%)';

                    Cart::update($item->rowId, [
                        'price' => $discountedPrice,
                        'options' => $options, // Cập nhật options
                    ]);
                }
            }

            return response()->json(['success' => true, 'message' => 'Áp dụng mã giảm giá thành công']);
        } else {
            return response()->json(['success' => false, 'message' => 'Mã giảm giá không hợp lệ hoặc đã hết hạn']);
        }
    }

    public function cancelDiscount()
    {
        $cartItems = Cart::content();

        foreach ($cartItems as $item) {
            $options = $item->options;
            $originalPrice = $item->options['original_price'];
            $originalImage = $item->options['image'];
            if (isset($options['voucher_applied']) && $options['voucher_applied']===true) {
                // Huỷ bỏ áp dụng mã giảm giá
                Cart::update($item->rowId, [
                    'price' => $originalPrice,
                    'options' => [
                        'image' => $originalImage,
                        'voucher_applied' => false,
                        'applied_voucher_code' => null,
                        'original_price' => null,
                    ],
                ]);
            }
        }

        return response()->json(['success' => true, 'message' => 'Đã huỷ áp dụng mã giảm giá']);
    }

    public function edit($id) {
        $voucher = Voucher::find($id);
//        $category_product = null;
        $category_product = Category_voucher::where('voucher_id', $voucher['id'])->select('category_id')->get()->toArray();
        foreach ($category_product as $key => $value) {
            $category_product[$key] = $value['category_id'];
        }
//        dd($category_product);
        $category = AdminCategoryController::getProductCategory();
        return view('admin.pages.editVoucher',compact('voucher','category','category_product'));
    }
    public function postEditVoucher(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'code' => 'required',
            'discount' => 'required|numeric|min:0|max:100',
            'condition' => 'nullable',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'quantity' => 'nullable|integer|min:1',
            'category' => 'required|array',
            [
                'category.array' => 'Danh mục sản phẩm không đúng định dạng',
                'category.required' => 'Vui lòng chọn danh mục sản phẩm',
            ]
        ]);
        $voucher = Voucher::find($id);
        $res = $voucher->update([
            'name' => $request->name,
            'code' => $request->code,
            'discount' => $request->discount,
            'condition' => $request->condition,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'quantity' => $request->quantity,
        ]);
        $categoryObj = new Category_voucher;
        foreach ($request->category as $key => $value) {
            $id_category = is_int((int)explode('_', $value)[0]) ? explode('_', $value)[0] : 0;
            $check = Category_voucher::where('category_id',$id_category)->where('voucher_id',$id)->count();
            if ($check==0)
            {
                $categoryObj->create([
                    'voucher_id' => $id,
                    'category_id' => $id_category,
                    'position' => 1,
                ]);
            } else {
                $categoryObj->update([
                    'voucher_id' => $id,
                    'category_id' => $id_category,
                    'position' => 1,
                ]);
            }

        }
        return redirect()->route('AdminVoucher');
    }
}
