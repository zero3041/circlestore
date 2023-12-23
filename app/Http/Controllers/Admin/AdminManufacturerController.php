<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ImageController;
use App\Models\Manufacturer;
use Illuminate\Http\Request;

class AdminManufacturerController extends Controller
{
    public function getManufacturer()
    {
        $manufacturer = Manufacturer::Paginate(10);
        foreach ($manufacturer as $key => $value) {
            $manufacturer[$key]['url'] = '/upload/manufacturer/'.$value['url'];
            if($value['active'] == true){
                $manufacturer[$key]['active'] = '<span class="badge bg-success">Hiển thị</span>';
            }
            else{
                $manufacturer[$key]['active'] = '<span class="badge bg-danger">Đang ẩn</span>';
            }
        }
        return view('admin.pages.manufacturer')->with('manufacturer',$manufacturer);
    }
    public function addManufacturer()
    {
        return view('admin.pages.editManufacturer');
    }
    public function editManufacturer($id)
    {
        $manufacturer = Manufacturer::find($id);
        if($manufacturer!=null){
            $manufacturer = $manufacturer->toArray();
        }
        return view('admin.pages.editManufacturer')->with('manufacturer',$manufacturer);
    }
    public function postAddManufacturer(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
            'active' => 'nullable|boolean',
            'image' => 'required|file|mimes:jpeg,jpg,png',
        ],[
            'name.required' => 'Vui lòng nhập tên thuộc tính',
            'active.boolean' => 'Hiển thị nhà sản xuất không đúng định dạng',
            'name.max' => 'Tên nhà sản xuất không quá 100 kí tự',
            'image.required' => 'Vui lòng nhập ảnh logo',
            'image.file' => 'Logo phải là một tập tin ảnh',
            'image.max' => 'Logo không đúng định dạng. Định dạng ảnh hợp lệ là: jpg, jpeg, png',
        ]);
        $manufacturer = new Manufacturer;
        $manufacturer->name = $request->name;
        if($request->active == 1){
            $manufacturer->active = 1;
        }
        else{
            $manufacturer->active = 0;
        }
        $uploadPath = public_path('/upload/manufacturer');
        $fileExtension = $request->image->getClientOriginalExtension();
        $fileName = time() . "_" . rand(0,9999999) . "_" . md5(rand(0,9999999)) . "." . $fileExtension;
        ImageController::resizeImagePost($request->image , $fileName, $uploadPath, 'manufacturer');
        $manufacturer->url = $fileName;
        $manufacturer->save();
        return redirect()->route('adminManufacturer');
    }
    public function postEditManufacturer(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:100',
            'active' => 'nullable|boolean',
            'image' => 'file|mimes:jpeg,jpg,png',
        ],[
            'name.required' => 'Vui lòng nhập tên thuộc tính',
            'active.boolean' => 'Hiển thị nhà sản xuất không đúng định dạng',
            'name.max' => 'Tên nhà sản xuất không quá 100 kí tự',
            'image.file' => 'Logo phải là một tập tin ảnh',
            'image.max' => 'Logo không đúng định dạng. Định dạng ảnh hợp lệ là: jpg, jpeg, png',
        ]);
        $manufacturer = Manufacturer::find($id);
        if($manufacturer!=null){
            $manufacturer->name = $request->name;
            if($request->active == 1){
                $manufacturer->active = 1;
            }
            else{
                $manufacturer->active = 0;
            }
            if($request->image != null){
                $uploadPath = public_path('/upload/manufacturer');
                if(file_exists($uploadPath.'/'.$manufacturer->url)){
                    @unlink($uploadPath.'/'.$manufacturer->url);
                    @unlink($uploadPath.'/home/'.$manufacturer->url);
                }
                $fileExtension = $request->image->getClientOriginalExtension();
                $fileName = time() . "_" . rand(0,9999999) . "_" . md5(rand(0,9999999)) . "." . $fileExtension;
                ImageController::resizeImagePost($request->image , $fileName, $uploadPath, 'manufacturer');
                $manufacturer->url = $fileName;
            }
            $manufacturer->save();
        }

        return redirect()->route('adminManufacturer');
    }
    public function deleteManufacturer(Request $request, $id)
    {
        $manufacturer = Manufacturer::find($id);
        if($manufacturer!=null){
            $manufacturer->delete();
            $uploadPath = public_path('/upload/manufacturer');
            if(file_exists($uploadPath.'/'.$manufacturer->url)){
                @unlink($uploadPath.'/'.$manufacturer->url);
                @unlink($uploadPath.'/home/'.$manufacturer->url);
            }
        }
        return redirect()->route('adminManufacturer');
    }
}
