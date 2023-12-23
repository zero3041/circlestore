<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ImageController;
use App\Models\Slide;
use Illuminate\Http\Request;

class AdminSlideController extends Controller
{
    public function getSlide()
    {
        $slide = Slide::Paginate(10);
        foreach ($slide as $key => $value) {
            $slide[$key]['url'] = '/upload/slide/' . $value['url'];
            if ($value['active'] == true) {
                $slide[$key]['active'] = '<span class="badge bg-success">Hiển thị</span>';
            } else {
                $slide[$key]['active'] = '<span class="badge bg-danger">Đang ẩn</span>';
            }
        }
        return view('admin.pages.slide')->with('slide', $slide);
    }

    public function addSlide()
    {
        return view('admin.pages.editSlide');
    }

    public function editSlide($id)
    {
        $slide = Slide::find($id);
        if ($slide != null) {
            $slide = $slide->toArray();
        }
        return view('admin.pages.editSlide')->with('slide', $slide);
    }

    public function postAddSlide(Request $request)
    {
        $request->validate([
            'text1' => 'nullable|max:250',
            'text2' => 'nullable|max:250',
            'text3' => 'nullable|max:250',
            'active' => 'nullable|boolean',
            'image' => 'required|file|mimes:jpeg,jpg,png',
        ], [
            'text1.max' => 'Nội dung 1 không quá 250 kí tự',
            'text2.max' => 'Nội dung 2 không quá 250 kí tự',
            'text3.max' => 'Nội dung 3 không quá 250 kí tự',
            'active.boolean' => 'Hiển thị nhà sản xuất không đúng định dạng',
            'image.required' => 'Vui lòng nhập ảnh logo',
            'image.file' => 'Logo phải là một tập tin ảnh',
            'image.mimes' => 'Logo không đúng định dạng. Định dạng ảnh hợp lệ là: jpg, jpeg, png',
        ]);
        $slide = new Slide;
        $slide->text1 = $request->text1;
        $slide->text2 = $request->text2;
        $slide->text3 = $request->text3;
        if ($request->active == 1) {
            $slide->active = 1;
        } else {
            $slide->active = 0;
        }
        $uploadPath = public_path('/upload/slide');
        $fileExtension = $request->image->getClientOriginalExtension();
        $fileName = time() . "_" . rand(0, 9999999) . "_" . md5(rand(0, 9999999)) . "." . $fileExtension;
        // $request->image->move($uploadPath, $fileName);
        ImageController::resizeImagePost($request->image, $fileName, $uploadPath, 'slide');
        $slide->url = $fileName;
        $slide->save();
        return redirect()->route('adminSlide');
    }

    public function postEditSlide(Request $request, $id)
    {
        $request->validate([
            'text1' => 'nullable|max:250',
            'text2' => 'nullable|max:250',
            'text3' => 'nullable|max:250',
            'active' => 'nullable|boolean',
            'image' => 'nullable|file|mimes:jpeg,jpg,png',
        ], [
            'text1.max' => 'Nội dung 1 không quá 250 kí tự',
            'text2.max' => 'Nội dung 2 không quá 250 kí tự',
            'text3.max' => 'Nội dung 3 không quá 250 kí tự',
            'active.boolean' => 'Hiển thị nhà sản xuất không đúng định dạng',
            'image.file' => 'Logo phải là một tập tin ảnh',
            'image.mimes' => 'Logo không đúng định dạng. Định dạng ảnh hợp lệ là: jpg, jpeg, png',
        ]);
        $slide = Slide::find($id);
        if ($slide != null) {
            $slide->text1 = $request->text1;
            $slide->text2 = $request->text2;
            $slide->text3 = $request->text3;
            if ($request->active == 1) {
                $slide->active = 1;
            } else {
                $slide->active = 0;
            }
            if ($request->image != null) {
                $uploadPath = public_path('/upload/slide');
                if (file_exists($uploadPath . '/' . $slide->url)) {
                    @unlink($uploadPath . '/' . $slide->url);
                    @unlink($uploadPath . '/home/' . $slide->url);
                }
                $fileExtension = $request->image->getClientOriginalExtension();
                $fileName = time() . "_" . rand(0, 9999999) . "_" . md5(rand(0, 9999999)) . "." . $fileExtension;
                ImageController::resizeImagePost($request->image, $fileName, $uploadPath, 'slide');
                $slide->url = $fileName;
            }
            $slide->save();
        }

        return redirect()->route('adminSlide');
    }

    public function deleteSlide(Request $request, $id)
    {
        $slide = Slide::find($id);
        if ($slide != null) {
            $slide->delete();
            $uploadPath = public_path('/upload/slide');
            if (file_exists($uploadPath . '/' . $slide->url)) {
                @unlink($uploadPath . '/' . $slide->url);
                @unlink($uploadPath . '/home/' . $slide->url);
            }
        }
        return redirect()->route('adminSlide');
    }
}
