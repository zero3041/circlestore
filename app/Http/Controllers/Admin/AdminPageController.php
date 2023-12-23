<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cms;
use Illuminate\Http\Request;

class AdminPageController extends Controller
{
    public function getPage()
    {
        $page = Cms::Paginate(10);
        foreach ($page as $key => $value) {
            if ($value['active'] == true) {
                $page[$key]['active'] = '<span class="badge bg-success">Hiển thị</span>';
            } else {
                $page[$key]['active'] = '<span class="badge bg-danger">Đang ẩn</span>';
            }
        }
        return view('admin.pages.page')->with('page', $page);
    }

    public function addPage()
    {
        return view('admin.pages.editPage');
    }

    public function editPage($id)
    {
        $page = Cms::find($id);
        if ($page != null) {
            $page = $page->toArray();
        }
        return view('admin.pages.editPage')->with('page', $page);
    }

    public function postAddPage(Request $request)
    {
        $request->validate([
            'title' => 'required|max:200',
            'page_description' => 'required',
            'active' => 'nullable|boolean',
        ], [
            'title.required' => 'Vui lòng nhập tiêu đề bài viết',
            'title.max' => 'Tiêu đề bài viết không quá 200 kí tự',
            'page_description.required' => 'Vui lòng nhập nội dung bài viết',
            'active.boolean' => 'Hiển thị bài viết không đúng định dạng',
        ]);
        $page = new Cms;
        $page->title = $request->title;
        $page->position = 1;
        $page->description = $request->page_description;
        if ($request->active == 1) {
            $page->active = 1;
        } else {
            $page->active = 0;
        }
        $page->save();
        return redirect()->route('adminPage');
    }

    public function postEditPage(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:200',
            'page_description' => 'required',
            'active' => 'nullable|boolean',
        ], [
            'title.required' => 'Vui lòng nhập tiêu đề bài viết',
            'title.max' => 'Tiêu đề bài viết không quá 200 kí tự',
            'page_description.required' => 'Vui lòng nhập nội dung bài viết',
            'active.boolean' => 'Hiển thị bài viết không đúng định dạng',
        ]);
        $page = Cms::find($id);
        if ($page != null) {
            $page->title = $request->title;
            $page->description = $request->page_description;
            $page->position = 1;
            if ($request->active == 1) {
                $page->active = 1;
            } else {
                $page->active = 0;
            }
            $page->save();
        }

        return redirect()->route('adminPage');
    }

    public function deletePage(Request $request, $id)
    {
        $page = Cms::find($id);
        if ($page != null) {
            $page->delete();
        }
        return redirect()->route('adminPage');
    }

    public function postShowHomeAPI(Request $request)
    {
        $validator = Validator::make($request->input(), array(
            'id' => 'required',
            'id' => 'integer',
            'action' => 'required',
            'action' => 'boolean',
        ));
        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'messages' => $validator->errors(),
            ], 422);
        }
        $page = Cms::find($request->id);
        if ($page != null) {
            $page->show_home = $request->action;
            $page->save();
            return response()->json(['error' => false, 'messages' => 'Cập nhật thành công']);
        }
        return response()->json(['error' => true, 'messages' => 'Không có giá trị nào']);
    }
}
