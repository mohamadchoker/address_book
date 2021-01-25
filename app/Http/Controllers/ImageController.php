<?php

namespace App\Http\Controllers;

use App\Helpers\ImageUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Intervention\Image\Facades\Image;

class ImageController extends ImageUpload
{
    public function upload(Request $request)
    {
        try{
            $img = new ImageUpload($request);
            $img->uploadImage();
            return Response::json(['status'=>true,'name'=> $img->getImgName()],200);
        }catch (\Exception $e){
            return response()->json(['status'=>false,'message'=>$e->getMessage()],($e->getCode() != 0) ? $e->getCode() : 500);
        }
    }


    public function getDefaultAvatar(Request $request)
    {
        try{
            if($request->has('name')){
                $full_name =  explode( ' ', $request->get('name'));

                if(count($full_name) > 1){
                    $f_name = $full_name[0];
                    $l_name = $full_name[1];

                    $first_letter = strtoupper($f_name[0]);
                    $sec_letter = strtoupper($l_name[0]);
                }else{
                    $string = $request->get('name');
                    $first_letter = strtoupper($string[0]);
                    $sec_letter = strtoupper($string[1]);
                }
                $text = $first_letter . $sec_letter;


                $color = stringToColorCode($request->get('name'));
                $img = Image::canvas(101, 101, $color);


                $img->text($text, 50.5, 50.5,function ($font) {
                    $font->file(public_path('fonts/Nunito-Regular.ttf'));
                    $font->size(45);
                    $font->color('#fff');
                    $font->align('center');
                    $font->valign('middle');
                });
                ob_end_clean();
                return $img->response();
            }
            return Response::json(['status'=>false,'message'=>'invalid name'],400);
        }catch (\Exception $e){
            return Response::json(['status'=>false,'message'=>$e->getMessage()]);
        }
    }



}

function stringToColorCode($str) {
    $code = dechex(crc32($str));
    $code = substr($code, 0, 6);

    return $code;
}
