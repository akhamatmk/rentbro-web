<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cost;

class ShippingController extends Controller
{
	public function courier(Request $request)
	{
		$destination = $request->destination;
		$weight = $request->weight;
		$origin = $request->origin;
		$courier = Cost::couriers($destination,$weight,$origin);
		return response()->json($courier);
	}

	public function price(Request $request)
	{
		$destination = $request->destination;
		$weight = $request->weight;
		$origin = $request->origin;
		$courier = $request->courier;
		$cost = Cost::calculate($destination,$courier,$weight,$origin);
		return response()->json($cost);
	}
}