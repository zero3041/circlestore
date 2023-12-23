<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feature;
use App\Models\Feature_value;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminFeatureController extends Controller
{
    private $feature, $valueFeature;
    public function __construct(Feature $feature, Feature_value $valueFeature)
    {
        $this->feature = $feature;
        $this->valueFeature = $valueFeature;
    }
    public function getFeature()
    {
        $feature = Feature::Paginate(10);
        foreach ($feature as $key => $value) {
            $feature[$key]['total'] = $this->valueFeature::where('id_feature',$value['id_feature'])->count();
        }
        return view('admin.pages.feature')->with('feature',$feature);
    }
    public function addFeature()
    {
        return view('admin.pages.editFeature');
    }
    public function editFeature($id)
    {
        $feature = $this->feature::find($id);
        if($feature!=null){
            $feature= $feature->toArray();
        }
        return view('admin.pages.editFeature')->with('feature',$feature);
    }
    public function postAddFeature(Request $request)
    {
        $request->validate([
            'name' => 'required|max:200',
        ],[
            'name.required' => 'Vui lòng nhập tên thuộc tính',
            'name.max' => 'Thông số không quá 200 ký tự',
        ]);
        $res = $this->feature->saveFeature($request);
        return redirect()->route('adminFeature');
    }
    public function postEditFeature(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:200',
        ],[
            'name.required' => 'Vui lòng nhập tên thuộc tính',
            'name.max' => 'Thông số không quá 200 ký tự',
        ]);
        $feature = $this->feature::find($id);
        if($feature!=null){
            $feature->name = $request->name;
            $feature->save();
        }
        return redirect()->route('adminFeature');
    }
    public function deleteFeature(Request $request, $id)
    {
        $feature = $this->feature::find($id);
        if($feature!=null){
            $feature->delete();
            $this->valueFeature::where('id_feature', $id)->delete();
        }
        return redirect()->route('adminFeature');
    }
    public function getValueFeature($id)
    {
        $feature = $this->feature::find($id);
        $featureValue = $this->valueFeature::where('id_feature', $id)->paginate(10);
        if($feature!=null){
            $feature = $feature->toArray();
        }
        return view('admin.pages.featureValue')->with(['featureValue'=>$featureValue,'feature'=>$feature]);
    }
    public function addValueFeature()
    {
        $feature = $this->feature::all()->toArray();
        return view('admin.pages.editValueFeature')->with('feature',$feature);
    }
    public function postAddValueFeature(Request $request)
    {
        $request->validate([
            'value' => 'required|max:200',
            'id_feature' => 'required'
        ],[
            'value.required' => 'Vui lòng nhập giá trị',
            'id_feature.required' => 'Vui lòng chọn thông số',
            'value.max' => 'Giá trị thông số không quá 200 ký tự',
        ]);

        $res = $this->valueFeature->saveValueFeature($request);
        return redirect()->route('adminFeature');
    }
    public function editValueFeature($id)
    {
        $featureValue = $this->valueFeature::find($id);
        $feature = $this->feature::all()->toArray();
        if($featureValue!=null){
            $featureValue= $featureValue->toArray();
        }
        return view('admin.pages.editValueFeature')->with(['featureValue'=>$featureValue,'feature'=>$feature]);
    }
    public function deleteValueFeature(Request $request, $id)
    {
        $featureValue = $this->valueFeature::find($id);
        if($featureValue!=null){
            $featureValue->delete();
        }
        return redirect()->back();
    }
    public function postEditValueFeature(Request $request, $id)
    {
        $request->validate([
            'value' => 'required|max:200',
            'id_feature' => 'required'
        ],[
            'value.required' => 'Vui lòng nhập giá trị',
            'id_feature.required' => 'Vui lòng chọn thông số',
            'value.max' => 'Giá trị thông số không quá 200 ký tự',
        ]);
        $featureValue = $this->valueFeature::find($id);
        if($featureValue!=null){
            $featureValue->value = $request->value;
            $featureValue->id_feature = $request->id_feature;
            $featureValue->save();
        }
        return redirect()->route('adminFeature');
    }

    public function getValueFeatureAPI(Request $request)
    {
        $validator = Validator::make($request->input(), array(
            'id' => 'required',
            'id' => 'integer',
        ));
        if ($validator->fails()) {
            return response()->json([
                'error'    => true,
                'messages' => $validator->errors(),
                'featureValue' => null
            ], 422);
        }
        $featureValue = $this->valueFeature->where('id_feature', $request->id)->get();
        if($featureValue != null){
            $featureValue = $featureValue->toArray();
            return response()->json(['error' => false, 'messages' => 'Thành công', 'featureValue' => $featureValue]);
        }
        return response()->json(['error' => true, 'messages' => 'Không có giá trị nào', 'featureValue' => null]);
    }
}
