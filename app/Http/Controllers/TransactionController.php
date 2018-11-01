<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cost;

class TransactionController extends Controller
{
	public function invoice($inv)
	{
		$response = get_api_response('invoice/'.$inv);
		return view('transaction/view')->with('data', $response->data);
	}
}