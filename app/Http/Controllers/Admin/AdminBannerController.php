<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ImageController;
use App\Models\Banner;
use Illuminate\Http\Request;

class AdminBannerController extends Controller
{
    public function getBanner()
    {
        $banner = Banner::Paginate(10);
        foreach ($banner as $key => $value) {
            $banner[$key]['image'] = '/upload/banner/'.$value['image'];
            if($value['active'] == true){
                $banner[$key]['active'] = '<span class="badge bg-success">Hiển thị</span>';
            }
            else{
                $banner[$key]['active'] = '<span class="badge bg-danger">Đang ẩn</span>';
            }
        }
        return view('admin.pages.banner')->with('banner',$banner);
    }
    public function addBanner()
    {
        return view('admin.pages.editBanner');
    }
    public function editBanner($id)
    {
        $banner = Banner::find($id);
        if($banner!=null){
            $banner = $banner->toArray();
        }
        return view('admin.pages.editBanner')->with('banner',$banner);
    }
    public function postAddBanner(Request $request)
    {
        $request->validate([
            'url' => 'required|max:250',
            'active' => 'nullable|boolean',
            'image' => 'required|file|mimes:jpeg,jpg,png',
        ],[
            'url.required' => 'Vui lòng nhập đường dẫn (link)',
            'active.boolean' => 'Hiển thị nhà sản xuất không đúng định dạng',
            'url.max' => 'Đường dẫn không quá 250 kí tự',
            'image.required' => 'Vui lòng nhập ảnh logo',
            'image.file' => 'Logo phải là một tập tin ảnh',
            'image.max' => 'Logo không đúng định dạng. Định dạng ảnh hợp lệ là: jpg, jpeg, png',
        ]);
        $banner = new Banner;
        $banner->url = $request->url;
        if($request->active == 1){
            $banner->active = 1;
        }
        else{
            $banner->active = 0;
        }
        $uploadPath = public_path('/upload/banner');
        $fileExtension = $request->image->getClientOriginalExtension();
        $fileName = time() . "_" . rand(0,9999999) . "_" . md5(rand(0,9999999)) . "." . $fileExtension;
        ImageController::resizeImagePost($request->image , $fileName, $uploadPath, 'banner');
        $banner->image = $fileName;
        $banner->save();
        return redirect()->route('adminBanner');
    }
    public function postEditBanner(Request $request, $id)
    {
        $request->validate([
            'url' => 'required|max:250',
            'active' => 'nullable|boolean',
            'image' => 'file|mimes:jpeg,jpg,png',
        ],[
            'url.required' => 'Vui lòng nhập đường dẫn (link)',
            'active.boolean' => 'Hiển thị nhà sản xuất không đúng định dạng',
            'url.max' => 'Đường dẫn không quá 250 kí tự',
            'image.file' => 'Logo phải là một tập tin ảnh',
            'image.max' => 'Logo không đúng định dạng. Định dạng ảnh hợp lệ là: jpg, jpeg, png',
        ]);
        $banner = Banner::find($id);
        if($banner!=null){
            $banner->url = $request->url;
            if($request->active == 1){
                $banner->active = 1;
            }
            else{
                $banner->active = 0;
            }
            if($request->image != null){
                $uploadPath = public_path('/upload/banner');
                if(file_exists($uploadPath.'/'.$banner->image)){
                    @unlink($uploadPath.'/'.$banner->image);
                    @unlink($uploadPath.'/home/'.$banner->image);
                }
                $fileExtension = $request->image->getClientOriginalExtension();
                $fileName = time() . "_" . rand(0,9999999) . "_" . md5(rand(0,9999999)) . "." . $fileExtension;
                ImageController::resizeImagePost($request->image , $fileName, $uploadPath, 'banner');
                $banner->image = $fileName;
            }
            $banner->save();
        }

        return redirect()->route('adminBanner');
    }
    public function deleteBanner(Request $request, $id)
    {
        $banner = Banner::find($id);
        if($banner!=null){
            $banner->delete();
            $uploadPath = public_path('/upload/banner');
            if(file_exists($uploadPath.'/'.$banner->image)){
                @unlink($uploadPath.'/'.$banner->image);
                @unlink($uploadPath.'/home/'.$banner->image);
            }
        }
        return redirect()->route('adminBanner');
    }
}
