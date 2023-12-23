<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ImageController;
use App\Models\Carrier;
use Illuminate\Http\Request;

class AdminCarrierController extends Controller
{
    public function getCarrier()
    {
        $carrier = Carrier::Paginate(10);
        foreach ($carrier as $key => $value) {
            $carrier[$key]['url'] = '/upload/carrier/home/' . $value['url'];
            if ($value['active'] == true) {
                $carrier[$key]['active'] = '<span class="badge bg-success">Hiển thị</span>';
            } else {
                $carrier[$key]['active'] = '<span class="badge bg-danger">Đang ẩn</span>';
            }
        }
        return view('admin.pages.carrier')->with('carrier', $carrier);
    }

    public function addCarrier()
    {
        return view('admin.pages.editCarrier');
    }

    public function editCarrier($id)
    {
        $carrier = Carrier::find($id);
        if ($carrier != null) {
            $carrier = $carrier->toArray();
        }
        return view('admin.pages.editCarrier')->with('carrier', $carrier);
    }

    public function postAddCarrier(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
            'price' => 'required|numeric',
            'active' => 'nullable|boolean',
            'image' => 'required|file|mimes:jpeg,jpg,png',
        ], [
            'name.required' => 'Vui lòng nhập tên thuộc tính',
            'active.boolean' => 'Hiển thị nhà sản xuất không đúng định dạng',
            'name.max' => 'Tên nhà sản xuất không quá 100 kí tự',
            'price.required' => 'Vui lòng nhập giá vận chuyển',
            'price.numeric' => 'Giá vận chuyển phải là số',
            'image.required' => 'Vui lòng nhập ảnh logo',
            'image.file' => 'Logo phải là một tập tin ảnh',
            'image.max' => 'Logo không đúng định dạng. Định dạng ảnh hợp lệ là: jpg, jpeg, png',
        ]);
        $carrier = new Carrier;
        $carrier->name = $request->name;
        $carrier->price = $request->price;
        if ($request->active == 1) {
            $carrier->active = 1;
        } else {
            $carrier->active = 0;
        }
        $uploadPath = public_path('/upload/carrier');
        $fileExtension = $request->image->getClientOriginalExtension();
        $fileName = time() . "_" . rand(0, 9999999) . "_" . md5(rand(0, 9999999)) . "." . $fileExtension;
        ImageController::resizeImagePost($request->image, $fileName, $uploadPath, 'carrier');
        $carrier->url = $fileName;
        $carrier->save();
        return redirect()->route('adminCarrier');
    }

    public function postEditCarrier(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:100',
            'price' => 'required|numeric',
            'active' => 'nullable|boolean',
            'image' => 'file|mimes:jpeg,jpg,png',
        ], [
            'name.required' => 'Vui lòng nhập tên thuộc tính',
            'active.boolean' => 'Hiển thị nhà sản xuất không đúng định dạng',
            'name.max' => 'Tên nhà sản xuất không quá 100 kí tự',
            'price.required' => 'Vui lòng nhập giá vận chuyển',
            'price.numeric' => 'Giá vận chuyển phải là số',
            'image.file' => 'Logo phải là một tập tin ảnh',
            'image.max' => 'Logo không đúng định dạng. Định dạng ảnh hợp lệ là: jpg, jpeg, png',
        ]);
        $carrier = Carrier::find($id);
        if ($carrier != null) {
            $carrier->name = $request->name;
            $carrier->price = $request->price;
            if ($request->active == 1) {
                $carrier->active = 1;
            } else {
                $carrier->active = 0;
            }
            if ($request->image != null) {
                $uploadPath = public_path('/upload/carrier');
                if (file_exists($uploadPath . '/' . $carrier->url)) {
                    @unlink($uploadPath . '/' . $carrier->url);
                    @unlink($uploadPath . '/home/' . $carrier->url);
                }
                $fileExtension = $request->image->getClientOriginalExtension();
                $fileName = time() . "_" . rand(0, 9999999) . "_" . md5(rand(0, 9999999)) . "." . $fileExtension;
                ImageController::resizeImagePost($request->image, $fileName, $uploadPath, 'carrier');
                $carrier->url = $fileName;
            }
            $carrier->save();
        }

        return redirect()->route('adminCarrier');
    }

    public function deleteCarrier(Request $request, $id)
    {
        $carrier = Carrier::find($id);
        if ($carrier != null) {
            $uploadPath = public_path('/upload/carrier');
            if (file_exists($uploadPath . '/' . $carrier->url)) {
                @unlink($uploadPath . '/' . $carrier->url);
                @unlink($uploadPath . '/home/' . $carrier->url);
            }
            $carrier->delete();
        }
        return redirect()->route('adminCarrier');
    }
}
