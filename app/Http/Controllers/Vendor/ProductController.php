<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Session;

class ProductController extends Controller
{
    public function add($vendor)
    {
        $vendor = get_api_response('vendor/'.$vendor.'/profile');
        if($vendor->code != 200)
            return redirect('/');

        $response = get_api_response('user/info');
        $catalogue = get_api_response('catalogue');
        $productOptpion = get_api_response('product/option');
        $price_type = ['Harian', 'Mingguan', 'Bulanan'];
    	return view('vendor/product/add')
                ->with('user', $response->data)
                ->with('vendor', $vendor->data)
                ->with('menu', 'add product')
                ->with('product_option', $productOptpion->data)
                ->with('price_type', $price_type)
                ->with('catalogue', $catalogue->data);
    }

    public function store($nickname)
    {        
        $option_value = [];
        if(isset($_POST['value']) AND count($_POST['value']) > 0)
        {
            foreach ($_POST['value'] as $key => $value) {
                $temp = explode("_", $value);
                $option_value[$temp[0]][] = $temp[1];
            }
        }

        $_POST['option_value'] = $option_value;
        
    	$response = get_api_response('vendor/'.$nickname.'/product/store', 'POST', [], $_POST);
        dd($response);
        if($response->code == 200)
            Session::flash('message-success', 'Sukses');
        else
            Session::flash('message-error', 'Gagal');

    	return redirect($_POST['nickname'].'/product-add');
    }
}
