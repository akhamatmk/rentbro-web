<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Session;

class VendorController extends Controller
{
    public function index()
    {
        $response = get_api_response('user/info');
        return view('user/vendor/detail')
                    ->with('user', $response->data)
                    ->with('menu', 'vendor')
                    ->with('active', 'vendor');
    }

    public function create()
    {
        $province = get_api_response('place/province');
    	return view('user/vendor/create')->with('province', $province->data);
    }

    public function profile($nickname)
    {

        $response = get_api_response('user/info');
        $vendor = get_api_response('vendor/'.$nickname.'/profile');
        if($vendor->code != 200)
            return redirect('/');

        return view('vendor/detail')
                    ->with('vendor', $vendor->data)
                    ->with('user', $response->data)
                    ->with('menu', 'vendor')
                    ->with('active', 'vendor_'.$vendor->data->nickname);
    }

    public function checkNickName()
    {
        $response = get_api_response('vendor/nickname/check', 'GET', [], $_GET);
        return response()->json($response);
    }

    public function store(Request $request)
    {
    	$rules = [
            'nick_name'	=> 'required',
            'full_name'	=> 'required'
        ];

    	$validator = Validator::make(
    		$request->all(),
    		$rules
		);

    	if ($validator->fails()){
            Session::flash('error_message', $validator->errors()->all());
    		return redirect('vendor/create');
        }

    	$response = get_api_response('vendor/create', 'POST', [], $_POST);
        if($response->code != 200){
            Session::flash('error_message', $response->message);
            return redirect('vendor/create');
        }
    
        return redirect('/');
    }

    public function category()
    {
        $category =  get_api_response('category');
        $cat = [];
        foreach ($category->data as $key => $value) {
            $cat['parent_0'][$key] =  $this->generateData($value);
            if(isset($value->subcategory))
            {
                foreach ($value->subcategory as $subkey1 => $subvalue1) {
                    $cat['parent_'.$value->id][$subkey1] =  $this->generateData($subvalue1);
                    if(isset($subvalue1->subcategory))
                    {
                        foreach ($subvalue1->subcategory as $subkey2 => $subvalue2) {
                            $cat['parent_'.$subvalue1->id][$subkey2] =  $this->generateData($subvalue2);
                        }
                    }
                }
            }
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
