<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
	public function add()
	{
		$response = get_api_response('user/info');
		if(! isset($response->data->id))
			return response()->json(['error' => true, 'message' => 'Anda Harus Login dulu']);

		$wishlist = get_api_response('wishlist/add', 'POST', [], $_GET);
		if($wishlist->code == 200)
			return response()->json(['error' => false, 'message' => 'Berhasil Ditambahkan Di wishlist']);
		else
			return response()->json(['error' => true, 'message' => 'gagal menambahkan item di wishlist']);
	}

	public function list()
	{
		$response = get_api_response('wishlist');
		return view('wishlist')
            	->with('wishlist', $response->data);
	}
}