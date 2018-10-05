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

        if(isset($_POST['storage']))
            $storage = $_POST['storage'];
        else
            $storage = 'product';

        $imageFileName = $storage.'-'.rand(0, 100000).time() . '.jpg';
    	$s3 = \Storage::disk('s3');
        $s3->put($storage.'/'.$imageFileName, $primary->getEncoded(), 'public');
		$s3->put($storage.'/thumbnail/'.$imageFileName, $thumbnail->getEncoded(), 'public');

		return $imageFileName;
    }
}
