<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
	public function detail($vendor, $product)
	{		
		$product = get_api_response('product/'.$vendor.'/'.$product);

		if(! isset($product->data->id))
			return view('not_found');

		$province = get_api_response('place/province');
		return view('product/detail')
					->with('product', $product->data)
					->with('province', $province->data);
	}
}