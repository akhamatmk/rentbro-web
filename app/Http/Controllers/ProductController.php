<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cost;

class ProductController extends Controller
{
	public function detail($vendor, $product)
	{		
		$product = get_api_response('product/'.$vendor.'/'.$product);
		if(! isset($product->data->id))
			return view('not_found');

		$province = get_api_response('place/province');
		$user = get_api_response('user/info');
		$vendor_location = get_api_response('vendor/'.$vendor.'/location/first')->data;
		
		$data_user = null;
		$address = [];
		$price_cod = 0;
		$courier = null;
		$cost = [];
		$distance = 0;
		if(! empty($user->data->id)){
			$address = get_api_response('user/address')->data;
			$data_user = $user->data;		
		}
		
		if($address != null)
		{
			$city_rajaongkir_user = $address[0]->city_rajaongkir_id;
			$city_rajaongkir_vendor = $vendor_location->regency->city_rajaongkir_id;
			$long_user = $address[0]->long;
			$lat_user = $address[0]->lat;
			$long_vendor = $vendor_location->longitude;
			$lat_vendor = $vendor_location->latitude;
			$distance = (int) ceil(distance($lat_user, $long_user, $lat_vendor, $long_vendor, "K"));
			if($distance > $product->data->max_cod_free)
			{
				$price_cod = $distance * $product->data->price_cod;
			}

			$courier = Cost::couriers($city_rajaongkir_user, $product->data->weight, $city_rajaongkir_vendor);
			if(isset($courier[0]))
			{				
				$result_cost = Cost::calculate($city_rajaongkir_user , $courier[0]['code'], $product->data->weight, $city_rajaongkir_vendor);
				if($result_cost != null)
					$cost = $result_cost['costs'];
			}			
		}

		return view('product/detail')
					->with('product', $product->data)
					->with('user', $data_user)
					->with('user_address', $address)
					->with('price_cod', $price_cod)
					->with('vendor_addres', $vendor_location)
					->with('distance', $distance)
					->with('courier', $courier)
					->with('cost', $cost)
					->with('province', $province->data);
	}

	public function chart($vendor, $product)
	{
		$response = get_api_response('product/'.$vendor.'/'.$product, 'POST', [], $_POST);
		if($response->code == 200)
			return redirect('chart');

		return redirect('product/'.$vendor.'/'.$product);
	}
}