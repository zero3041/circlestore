<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminCategoryController extends Controller
{
    public $result = [];
    public function getCategory()
    {
        $this->result = 1;
        $category = Category::Paginate(10);
        foreach ($category as $key => $value) {
            if($value['active'] == true){
                $category[$key]['active'] = '<span class="badge bg-success">Hiển thị</span>';
            }
            else{
                $category[$key]['active'] = '<span class="badge bg-danger">Đang ẩn</span>';
            }
        }
        return view('admin.pages.category')->with('category',$category);
    }
    public function addCategory()
    {
        $category = self::getProductCategory();
        return view('admin.pages.editCategory')->with(['category'=>$category]);
    }

    function data_tree($data, $parent_id = 0, $level = 1, $result)
    {
        $result = $this->result;
        if(count($data)){
            foreach($data as $key=>$value){
                if($value['id_parent'] == $parent_id){
                    $value['level'] = $level;
                    $result[] = $value;
                    unset($data[$key]);
                    $parents = $value['id_category'];

                    $this->result = $result;
                    $this->data_tree($data, $parents, $level + 1, $result);
                }
            }
        }
        return $this->result;
    }
    public function editCategory($id)
    {
        $categories = Category::find($id);

        $category = array();
        for($i=1;$i<=4;$i++){
            $level = 'level'.$i;
            if(Category::where('level',$i)->get()!=null){
                $category[$level] = Category::where('level',$i)->get()->toArray();
            }
            else{
                $category[$level] = [];
            }
        }
        if($categories !=null){
            $categories = $categories->toArray();
            $id_category = Category::where('id_parent',$categories['id_category']);
        }
        return view('admin.pages.editCategory')->with(['category'=>$category, 'categories'=>$categories]);
    }
    public function postAddCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|max:50',
            'category' => 'required',
            'active' => 'nullable|boolean',
//            'image' => 'required|file|mimes:jpeg,jpg,png',
        ],[
            'name.required' => 'Vui lòng nhập tên danh mục',
            'category.required' => 'Vui lòng chọn danh mục cha',
            'name.min' => 'Tên danh mục không quá 50 ký tự',
            'active.boolean' => 'Hiển thị danh mục không đúng',
//            'image.required' => 'Vui lòng nhập ảnh',
//            'image.file' => 'Phải là một tập tin ảnh',
//            'image.mimes' => 'Ảnh không đúng định dạng. Định dạng ảnh hợp lệ là: jpg, jpeg, png',
        ]);
        $category = explode('_', $request->category);

        $id_category = is_int((int)$category[0])?$category[0]:0;
        $level = (is_int((int)$category[1])?$category[1]:0)+1;
        $category = new Category;
        $category->name = $request->name;
        $category->active = $request->active==1?1:0;
        $category->position = 1;
        if($id_category==0){
            $category->id_parent = 0;
            $category->level = 1;
        }
        else{
            $category->id_parent = $id_category;
            $category->level = $level;
        }
        $fileName = '';
        if($request->has('image')){
            $uploadPath = public_path('/upload/category');
            $fileExtension = $request->image->getClientOriginalExtension();
            $fileName = time() . "_" . rand(0,9999999) . "_" . md5(rand(0,9999999)) . "." . $fileExtension;
            ImageController::resizeImagePost($request->image , $fileName, $uploadPath, 'category');
        }

        $category->url = $fileName;
        $category->save();

        return redirect()->route('adminCategory');
    }
    public function postEditCategory(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:50',
            'category' => 'required',
            'active' => 'nullable|boolean',
            'image' => 'nullable|file|mimes:jpeg,jpg,png',
        ],[
            'name.required' => 'Vui lòng nhập tên danh mục',
            'category.required' => 'Vui lòng chọn danh mục cha',
            'name.min' => 'Tên danh mục không quá 50 ký tự',
            'active.boolean' => 'Hiển thị danh mục không đúng',
            'image.file' => 'Phải là một tập tin ảnh',
            'image.mimes' => 'Ảnh không đúng định dạng. Định dạng ảnh hợp lệ là: jpg, jpeg, png',
        ]);
        $category = explode('_', $request->category);

        $id_category = is_int((int)$category[0])?$category[0]:0;
        $level = (is_int((int)$category[1])?$category[1]:0)+1;
        $category = Category::find($id);
        if($category->level<$level&&$id_category!=0){
            return redirect()->route('editCategory',['id'=>$id])->with('error','Không thể di chuyển danh mục này vào danh mục cùng cấp hoặc danh mục con');
        }
        else{
            $category->name = $request->name;
            $category->active = $request->active==1?1:0;
            $category->position = 1;
            if($id_category==0){
                $category->id_parent = 0;
                $category->level = 1;
            }
            else{
                $category->id_parent = $id_category;
                $category->level = $level;
            }
            if($request->image != null){
                $uploadPath = public_path('/upload/category');
                if(file_exists($uploadPath.'/'.$category->url)){
                    @unlink($uploadPath.'/'.$category->url);
                    @unlink($uploadPath.'/home/'.$category->url);
                }
                $fileExtension = $request->image->getClientOriginalExtension();
                $fileName = time() . "_" . rand(0,9999999) . "_" . md5(rand(0,9999999)) . "." . $fileExtension;
                ImageController::resizeImagePost($request->image , $fileName, $uploadPath, 'category');
                $category->url = $fileName;
            }
            $category->save();
        }
        return redirect()->route('adminCategory');
    }
    public function deleteCategory(Request $request, $id)
    {
        $category = Category::find($id);
        if($category!=null){
            $category->delete();
            $category_chirld = Category::where('id_parent',$id)->get();
            $category_chirld_arr = $category_chirld->toArray();
            if($category_chirld_arr!=null){
                foreach($category_chirld as $value){
                    $uploadPath = public_path('/upload/category');
                    if(file_exists($uploadPath.'/'.$value->url)){
                        @unlink($uploadPath.'/'.$value->url);
                        @unlink($uploadPath.'/home/'.$category->url);
                    }
                }
                $value->delete();
            }


            $uploadPath = public_path('/upload/category');
            if(file_exists($uploadPath.'/'.$category->url)){
                @unlink($uploadPath.'/'.$category->url);
                @unlink($uploadPath.'/home/'.$category->url);
            }
        }
        return redirect()->route('adminCategory');
    }
    public static function getProductCategory()
    {
        $category = array();
        for($i=1;$i<=4;$i++){
            $level = 'level'.$i;
            if(Category::where('level',$i)->get()!=null){
                $category[$level] = Category::where('level',$i)->get()->toArray();
            }
            else{
                $category[$level] = [];
            }
        }
        return $category;
    }
    public function showHome()
    {
        $category = Category::Paginate(10);
        foreach ($category as $key => $value) {
            if($value['active'] == true){
                $category[$key]['active'] = '<span class="badge bg-success">Hiển thị</span>';
            }
            else{
                $category[$key]['active'] = '<span class="badge bg-danger">Đang ẩn</span>';
            }
        }
        return view('admin.pages.showHomeCategory')->with('category',$category);
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
                'error'    => true,
                'messages' => $validator->errors(),
            ], 422);
        }
        $category = Category::find($request->id);
        if($category != null){
            $category->show_home = $request->action;
            $category->save();
            return response()->json(['error' => false, 'messages' => 'Cập nhật thành công']);
        }
        return response()->json(['error' => true, 'messages' => 'Không có giá trị nào']);
    }
}
