<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Attribute_group;
use Illuminate\Http\Request;

class AdminAttributeController extends Controller
{
    private $attr, $valueAttr;
    public function __construct(Attribute_group $attr, Attribute $valueAttr)
    {
        $this->attr = $attr;
        $this->valueAttr = $valueAttr;
    }
    public function getAttribute()
    {
        $attrbuteGroup = Attribute_group::Paginate(10);
        foreach ($attrbuteGroup as $key => $value) {
            if($value['group_type'] == 'select'){
                $attrbuteGroup[$key]['group_type'] = 'Danh sách';
            }elseif($value['group_type'] == 'radio'){
                $attrbuteGroup[$key]['group_type'] = 'Nút lựa chọn';
            }else{
                $attrbuteGroup[$key]['group_type'] = 'Màu sắc';
            }
            $attrbuteGroup[$key]['total'] = $this->valueAttr::where('id_attribute_group',$value['id_attribute_group'])->count();
        }
        return view('admin.pages.attribute')->with('attrbuteGroup',$attrbuteGroup);
    }
    public function addAttribute()
    {
        return view('admin.pages.editAttribute');
    }
    public function editAttribute($id)
    {
        $attrbuteGroup = $this->attr::find($id);
        if($attrbuteGroup!=null){
            $attrbuteGroup= $attrbuteGroup->toArray();
        }
        return view('admin.pages.editAttribute')->with('attrbuteGroup',$attrbuteGroup);
    }
    public function postAddAttribute(Request $request)
    {
        $request->validate([
            'name' => 'required|max:50',
            'type' => 'required'
        ],[
            'name.required' => 'Vui lòng nhập tên thuộc tính',
            'type.required' => 'Vui lòng chọn kiểu thuộc tính',
            'name.min' => 'Tên thuộc tính không quá 50 ký tự',
        ]);
        $res = $this->attr->saveAttr($request);
        return redirect()->route('adminAttribute');
    }
    public function postEditAttribute(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:50',
            'type' => 'required'
        ],[
            'name.required' => 'Vui lòng nhập tên thuộc tính',
            'type.required' => 'Vui lòng chọn kiểu thuộc tính',
            'name.min' => 'Tên thuộc tính không quá 50 ký tự',
        ]);
        $attrbuteGroup = $this->attr::find($id);
        if($attrbuteGroup!=null){
            $attrbuteGroup->name = $request->name;
            $attrbuteGroup->group_type = $request->type;
            $attrbuteGroup->save();
        }
        return redirect()->route('adminAttribute');
    }
    public function deleteAttribute(Request $request, $id)
    {
        $attrbuteGroup = $this->attr::find($id);
        if($attrbuteGroup!=null){
            $attrbuteGroup->delete();
            $this->valueAttr::where('id_attribute_group', $id)->delete();
        }
        return redirect()->route('adminAttribute');
    }
    public function getValueAttribute($id)
    {
        $attrbuteGroup = $this->attr::find($id);
        $attrbuteValue = $this->valueAttr::where('id_attribute_group', $id)->paginate(10);
        if($attrbuteGroup!=null){
            $attrbuteGroup = $attrbuteGroup->toArray();
        }
        return view('admin.pages.attributeValue')->with(['attrbuteValue'=>$attrbuteValue,'attrbuteGroup'=>$attrbuteGroup]);
    }
    public function addValueAttribute()
    {
        $attrbuteGroup = $this->attr::all()->toArray();
        return view('admin.pages.editValueAttribute')->with('attrbuteGroup',$attrbuteGroup);
    }
    public function postAddValueAttribute(Request $request)
    {
        $request->validate([
            'value' => 'required|max:50',
            'id_attribute_group' => 'required'
        ],[
            'value.required' => 'Vui lòng nhập tên giá trị thuộc tính',
            'id_attribute_group.required' => 'Vui lòng chọn kiểu thuộc tính',
            'value.min' => 'Giá trị thuộc tính không quá 50 ký tự',
        ]);

        $res = $this->valueAttr->saveValueAttr($request);
        return redirect()->route('adminAttribute');
    }
    public function editValueAttribute($id)
    {
        $attrbuteValue = $this->valueAttr::find($id);
        $attrbuteGroup = $this->attr::all()->toArray();
        if($attrbuteValue!=null){
            $attrbuteValue= $attrbuteValue->toArray();
        }
        return view('admin.pages.editValueAttribute')->with(['attrbuteValue'=>$attrbuteValue,'attrbuteGroup'=>$attrbuteGroup]);
    }
    public function deleteValueAttribute(Request $request, $id)
    {
        $attrbuteValue = $this->valueAttr::find($id);
        if($attrbuteValue!=null){
            $attrbuteValue->delete();
        }
        return redirect()->back();
    }
    public function postEditValueAttribute(Request $request, $id)
    {
        $request->validate([
            'value' => 'required|max:50',
            'id_attribute_group' => 'required'
        ],[
            'value.required' => 'Vui lòng nhập tên giá trị thuộc tính',
            'id_attribute_group.required' => 'Vui lòng chọn kiểu thuộc tính',
            'value.min' => 'Giá trị thuộc tính không quá 50 ký tự',
        ]);
        $attrbuteValue = $this->valueAttr::find($id);
        if($attrbuteValue!=null){
            $attrbuteValue->name = $request->value;
            $attrbuteValue->id_attribute_group = $request->id_attribute_group;
            $attrbuteValue->color = $request->color;
            $attrbuteValue->save();
        }
        return redirect()->route('adminAttribute');
    }
}
