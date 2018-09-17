<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class ProductOptionController extends Controller
{
    public function multiple()
    {
    	$response = get_api_response('product/option/multiple', 'POST', [], $_POST);
    	return response()->json($response->data);
    }
}
