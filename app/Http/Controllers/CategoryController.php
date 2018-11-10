<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cost;

class CategoryController extends Controller
{
	public function index()
	{
		$category = get_api_response('category');
		$html = view('layout.category')->with(['category' => $category->data])->render();
		return response()->json(['html' => $html]);
	}

	public function product($alias)
	{
		$category = get_api_response('category/product/'.$alias);
		return view('product_by_category')->with('product', $category->data)->with('category', $alias);
	}
}