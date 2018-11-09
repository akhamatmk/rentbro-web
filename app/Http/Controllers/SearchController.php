<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cost;

class SearchController extends Controller
{
	public function index()
	{
		$product = get_api_response('search/product', 'GET', [], $_GET);
		return view('search')
            	->with('product', $product->data);
	}
}