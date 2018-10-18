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
		$user = get_api_response('user/info');
		$vendor_location = get_api_response('vendor/'.$vendor.'/location/first')->data;
		
		$data_user = null;
		$address = null;
		$price_cod = 0;
		if(! empty($user->data->id)){
			$address = get_api_response('user/address')->data;
			$data_user = $user->data;		
		}

		if($address != null)
		{
			$long_user = $address[0]->long;
			$lat_user = $address[0]->lat;
			$long_vendor = $vendor_location->long;
			$lat_vendor = $vendor_location->lat;
			$distance = (int) ceil(distance($lat_user, $long_user, $lat_vendor, $long_vendor, "K"));			
			if($distance > $product->data->max_cod_free)
			{
				$price_cod = $distance * $product->data->price_cod;
			}
		}

		return view('product/detail')
					->with('product', $product->data)
					->with('user', $data_user)
					->with('user_address', $address)
					->with('price_cod', $price_cod)
					->with('vendor_addres', $vendor_location)
					->with('distance', $distance)
					->with('province', $province->data);
	}
}