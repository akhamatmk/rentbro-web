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
        $price_type = ['Harian', 'Mingguan', 'Bulanan']; 
    	return view('vendor/product/add')
                ->with('user', $response->data)
                ->with('vendor', $vendor->data)
                ->with('menu', 'add product')
                ->with('price_type', $price_type)
                ->with('catalogue', $catalogue->data);
    }

    public function store($vendor_id)
    {
    	$response = get_api_response('vendor/'.$vendor_id.'/product/store', 'POST', [], $_POST);
        if($response->code == 200)
            Session::flash('message-success', 'Sukses');
        else
            Session::flash('message-error', 'Gagal');

    	return redirect($_POST['nickname'].'/product-add');
    }
}
