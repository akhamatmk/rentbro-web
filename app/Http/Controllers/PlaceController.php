<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class PlaceController extends Controller
{
    public function regency()
    {
    	$regency = get_api_response('place/regency', 'GET', [], $_GET);
    	return ["data" => $regency->data];    	
    }

    public function district()
    {
    	$district = get_api_response('place/district', 'GET', [], $_GET);
    	return ["data" => $district->data];    	
    }
}
