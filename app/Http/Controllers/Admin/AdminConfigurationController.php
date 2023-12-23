<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ImageController;
use App\Models\Configuration;
use Illuminate\Http\Request;

class AdminConfigurationController extends Controller
{
    public function getConfiguration()
    {
        $configuration = Configuration::Paginate(10);
        foreach ($configuration as $key => $value) {

            switch($value['name']){
                case 'LOGO': $configuration[$key]['public_name'] = 'Logo cửa hàng';break;
                case 'SHOP_NAME': $configuration[$key]['public_name'] = 'Tên cửa hàng';break;
                case 'ADDRESS': $configuration[$key]['public_name'] = 'Địa chỉ cửa hàng';break;
                case 'PHONE': $configuration[$key]['public_name'] = 'Số điện thoại';break;
                case 'EMAIL': $configuration[$key]['public_name'] = 'Email liên hệ';break;
            }
        }
        return view('admin.pages.configuration')->with('configuration',$configuration);
    }

    public function editConfiguration($id)
    {
        $configuration = Configuration::find($id);
        if($configuration!=null){
            $configuration = $configuration->toArray();
        }
        return view('admin.pages.editConfiguration')->with('configuration',$configuration);
    }
    public function postEditConfiguration(Request $request, $id)
    {

        $request->validate([
            'value' => 'max:200',
            'image' => 'file|mimes:jpeg,jpg,png',
        ],[
            'value.max' => 'Tên cấu hình không quá 200 kí tự',
            'image.file' => 'Logo phải là một tập tin ảnh',
            'image.mimes' => 'Logo không đúng định dạng. Định dạng ảnh hợp lệ là: jpg, jpeg, png',
        ]);
        $configuration = Configuration::find($id);

        if($configuration!=null){
            if($configuration->name == 'PHONE'){
                $request->validate([
                    'value' => 'numeric',
                ],[
                    'value.numeric' => 'Số điện thoại phải là chữ số',
                ]);
            }
            if($configuration->name == 'EMAIL'){
                $request->validate([
                    'value' => 'email',
                ],[
                    'value.email' => 'Email không đúng định dạng',
                ]);
            }
            if ($request->has('value')) {
                $configuration->value = $request->value;

            }
            if ($request->has('image')) {
                if($request->image != null){
                    $uploadPath = public_path('/upload/configuration');
                    if(file_exists($uploadPath.'/'.$configuration->value)){
                        @unlink($uploadPath.'/'.$configuration->value);
                        @unlink($uploadPath.'/home/'.$configuration->value);
                        @unlink($uploadPath.'/small/'.$configuration->value);
                    }
                    $image = $request->image;
                    $fileExtension = $request->image->getClientOriginalExtension();
                    $fileName = time() . "_" . rand(0,9999999) . "_" . md5(rand(0,9999999)) . "." . $fileExtension;
                    ImageController::resizeImagePost($image , $fileName, $uploadPath, 'configuration,logoSmall');
                    $configuration->value = $fileName;
                }
            }

            $configuration->save();
        }

        return redirect()->route('adminConfiguration');
    }
}
