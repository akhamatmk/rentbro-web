<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class UploadController extends Controller
{
    public function imageUpload(Request $request)
    {
    	$image = $request->file('image');
        $primary = Image::make($request->file('image'))->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->encode('jpg');
        $thumbnail = Image::make($request->file('image'))->resize(50,50)->encode('jpg');
        $imageFileName = 'product-'.rand(0, 100000).time() . '.jpg';
    	$s3 = \Storage::disk('s3');
        $s3->put('product/'.$imageFileName, $primary->getEncoded());
		$s3->put('product/thumbnail/'.$imageFileName, $thumbnail->getEncoded());

		return $imageFileName;
    }
}
