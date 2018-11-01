<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cost;

class ChartController extends Controller
{
	public function ajax()
	{
		$response = get_api_response('chart/list/ajax');
		$count = 0;
		if($response->code == 200)
			$count = count($response->data);

		return response()->json(['count' => $count]);
	}

	public function list()
	{
		$chart = get_api_response('chart/list');
		$address = get_api_response('user/address')->data;
		$courier = Cost::couriers(399, 1, 399);
		$result_cost = Cost::calculate(399, $courier[0]['code'], 1, 399);
		if($result_cost != null)
					$cost = $result_cost['costs'];

		return view('chart')
		->with('data', (array) $chart->data)
		->with('courier', $courier)
		->with('cost',$cost)
		->with('user_address', (array) $address);
	}

	public function checkout()
	{
		$response = get_api_response('chart/checkout', 'POST', [], $_POST);
		return redirect('invoice/'.$response->data->code_trans);
	}

	public function destroy($chart)
	{
		$response = get_api_response('chart/'.$chart, 'DELETE');
		return response()->json($response->data);
	}
}