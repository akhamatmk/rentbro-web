<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Session;

class ShopController extends Controller
{
    public function create()
    {
        $response = get_api_response('user/info');
    	return view('user/shop/create');
    }

    public function store(Request $request)
    {
    	$rules = [
            'name_shop'	=> 'required',
            'url_shop'	=> 'required'
        ];

    	$validator = Validator::make(
    		$request->all(),
    		$rules
		);

    	if ($validator->fails()){
            Session::flash('error_message', $validator->errors()->all());
    		return redirect('myshop');
        }

    	$response = get_api_response('shop/register', 'POST', [], $_POST);

    	if($response->code != 200)            
            return view('user/shop/create')->with('error_message', $response->message);
        
        return redirect('/');
    }

    public function category()
    {
        $category =  get_api_response('category');        
        $cat = [];
        foreach ($category->data as $key => $value) {

            if($value->parent_id == null OR $value->parent_id == 0)
                $value->parent_id = 0;
            
            $cat['parent_'.$value->parent_id][] =  $this->generateData($value);            
        }

        echo json_encode($cat);
    }

    public function generateData($value)
    {
        $data['id'] = $value->id;
        $data['name'] = $value->name;
        $data['description'] = $value->description;
        $data['icon'] = $value->icon;
        return $data;
    }
}
