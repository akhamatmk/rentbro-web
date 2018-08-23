<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use JD\Cloudder\Facades\Cloudder;
use Faker\Provider\Image;

class UploadController extends Controller
{
    public function imageUpload(Request $request)
    {
    	$result_upload = Cloudder::upload($request->file('image')->getPathName());
    	$result = $result_upload->getResult();

    	$result['secure_url'] = str_replace('""', '', $result['secure_url']);
    	return $result['secure_url'];
    }
}
