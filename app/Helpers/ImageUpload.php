<?php
/**
 * User: Choker
 * Date: 01/24/2019
 * Time: 4:09 PM
 */

namespace App\Helpers;

use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;


/**
 * Class ImageUpload
 * @package App\Helpers
 */
class ImageUpload
{
    /**
     * @var Request
     */
    protected $request;
    /**
     * @var string
     */
    private $img_name = '';

    /**
     * ImageUpload constructor.
     * @param $request
     * @param $source
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @return string
     */
    protected function getImgName(): string
    {
        return $this->img_name;
    }

    /**
     * @return bool
     * @throws \Exception
     */
    protected function uploadImage()
    {
        $this->validate($this->request);
        $name = $this->createName();
        $this->setImgName($name);

        $file = str_replace('data:image/png;base64,', '',$this->request->image);
        $img = str_replace(' ', '+', $file);
        $data = base64_decode($img);


        $this->uploadToStorage('_60x60', $name, $this->makeImage($data, 60, 60, 90));
        $this->uploadToStorage('', $name, $this->makeImage($data, null, null, 100));


        return true;


    }

    /**
     * @param Request $request
     * @return bool
     * @throws \Exception
     */
    private function validate(Request $request)
    {

        $input = $request->all();
        $rules = array(
            'image' => 'required'
        );
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            throw new \Exception($validator->errors()->first(), 422);
        }

        return true;
    }

    /**
     * @param $source
     * @return string
     * @throws \Exception
     */
    private function createName()
    {
        $t = microtime(true);
        $micro = sprintf("%04d", ($t - floor($t)) * 10000);
        $d = new DateTime(date('Y-m-d H:i:s.' . $micro, $t));
        $random_time = $d->format("dmYHisu");
        $filename = 'avatars/'.$random_time;
        return $filename;
    }

    /**
     * @param string $img_name
     */
    private function setImgName(string $img_name)
    {
        $this->img_name = $img_name;
    }

    /**
     * @param $type
     * @param $file_name
     * @param $img
     * @return bool
     */
    private function uploadToStorage($size, $file_name, $img)
    {
        return Storage::disk('public')->put($file_name.$size, $img->getEncoded());
    }


    /**
     * @param $img
     * @param $width
     * @param $height
     * @param $quality
     * @return mixed
     */
    private function makeImage($img, $width, $height, $quality)
    {
        if($width == null and $height == null)
        {
            $image = Image::make($img)->encode('jpg', $quality);
        } else {
            $image = Image::make($img)->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->encode('jpg', $quality);
        }


        return $image;
    }

}
