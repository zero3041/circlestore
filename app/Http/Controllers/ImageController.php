<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;

class ImageController extends Controller
{
    public static function resizeImagePost($image, $imageName, $path, $field)
    {
        $width = 100;
        $height = 100;
        $fields = explode(',', $field);
        $destinationPath = $path;
        foreach ($fields as $value) {
            $destinationPath = $path . '/home';
            switch ($value) {
                case 'banner':
                    $width = 370;
                    $height = 280;
                    break;
                case 'slide':
                    $width = 1920;
                    $height = 738;
                    break;
                case 'category':
                    $width = 330;
                    $height = 410;
                    break;
                case 'product':
                    $width = 240;
                    $height = 291;
                    break;
                case 'manufacturer':
                    $width = 130;
                    $height = 50;
                    break;
                case 'supplier':
                    $width = 130;
                    $height = 50;
                    break;
                case 'configuration':
                    $width = 135;
                    $height = 50;
                    break;
                case 'logoSmall':
                    $width = 135;
                    $height = 20;
                    $destinationPath = $path . '/small';
                    break;
            }
            $img = Image::make($image->path());
            $img->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $imageName);
        }
        $destinationPath = $path;
        $image->move($destinationPath, $imageName);

    }
}
