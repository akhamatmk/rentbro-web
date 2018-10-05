<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cost;

class HomeController extends Controller
{
	public function index()
	{
		$product = get_api_response('product/list');
		return view('welcome')->with('product', $product->data);
	}
}