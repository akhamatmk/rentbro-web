<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
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
        $price_type[1] = 'Harian';
        $price_type[2] = 'Mingguan'; 
        $price_type[3] = 'Bulanan';

    	return view('vendor/product/add')
                ->with('user', $response->data)
                ->with('vendor', $vendor->data)
                ->with('menu', 'add product')
                ->with('product_option', $productOptpion->data)
                ->with('price_type', $price_type)
                ->with('catalogue', $catalogue->data);
    }

    public function store($nickname, Request $request)
    {

        $rules = [
            'name'                  => 'required',
            'product_image_primary' => 'required',
            'price'                 => 'required',
            'weight'                => 'required'
        ];

        $validator = Validator::make(
            $request->all(),
            $rules
        );

        if ($validator->fails()){
            Session::flash('error_message', $validator->errors()->all());
            return redirect()->back();
        }

        $option_value = [];
        if(count($request->value) > 0)
        {
            foreach ($request->value as $key => $value) {
                $temp = explode("_", $value);
                $option_value[$temp[0]][] = $temp[1];
            }
        }

        $_POST['option_value'] = $option_value;
        $_POST['quantity'] = 100;

        if(isset($_POST['minimum_deposit']))
            $_POST['minimum_deposit'] = (int) str_replace(".", "", $request->minimum_deposit);
        else
            $_POST['minimum_deposit'] = 0;

        $price = [];
        foreach ($request->price as $key => $value) {
            $price[] = (int) str_replace(".", "", $value);
        }

        $_POST['price'] = $price;
        if(count($_POST['product_images']) > 0)
        {
            $product_images = $_POST['product_images'];
            $product_image_primary = $_POST['product_image_primary'];
            $result_image = array_diff($product_images, [$product_image_primary]);

            $_POST['product_images'] = $result_image;
        }


        $response = get_api_response('vendor/'.$nickname.'/product/store', 'POST', [], $_POST);
        if($response->code == 200)
            Session::flash('message-success', 'Sukses');
        else
            Session::flash('message-error', 'Gagal');

    	return redirect($nickname.'/product-add');
    }
}
