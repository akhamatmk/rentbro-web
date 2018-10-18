<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Session;

class UserController extends Controller
{
    public function profile()
    {
    	$response = get_api_response('user/info');
    	return view('user/profile')
                    ->with('user', $response->data)
                    ->with('menu', 'account')
                    ->with('active', 'profile');
    }

    public function delete_address($id)
    {
        $response = get_api_response('user/address/'.$id, 'DELETE');
        return response()->json(true);
    }

    public function edit_address($id, Request $request)
    {
        $data['province'] = $request->province;
        $data['regency'] = $request->regency;
        $data['district'] = $request->district;
        $data['name'] = $request->name;
        $data['phone'] = $request->phone;
        $data['postal_code'] = $request->postal_code;
        $data['full_address'] = $request->full_address;
        $data['primary'] = $request->primary;
        $data['map_street'] = $request->map_street;
        $data['long'] = $request->long;
        $data['lat'] = $request->lat;

        $response = get_api_response('user/address/'.$id, 'PUT', [], $data);
        return response()->json($response->code);
    }

    public function detail_address($id)
    {
        $response = get_api_response('user/address/'.$id);
        return response()->json($response);
    }

    public function address()
    {
        $response = get_api_response('user/info');
        $province = get_api_response('place/province');
        $address = get_api_response('user/address');
        return view('user/address')
                    ->with('user', $response->data)
                    ->with('menu', 'account')
                    ->with('address', $address->data)
                    ->with('province', $province->data)
                    ->with('active', 'address');   
    }

    public function make_new_password(Request $request)
    {
        $response = get_api_response('user/set/new/password', 'POST', [], $_POST);
        if($response->code != 200 )
            return back();

        Session::flash('message-success', 'password berhasil diganti');
        return redirect('account/change_password');
    }

    public function send_code_new_password()
    {
        $response = get_api_response('user/send/code/newPassword', 'GET', [], ['type' => 1]);
        if($response->code != 200)
            return redirect('user/make/newPassword');

        $response = get_api_response('user/info');

        return view('user/send_code_make_password_succes')
                    ->with('user', $response->data)
                    ->with('menu', 'account')
                    ->with('active', 'change_password');
    }

    public function verify_code_new_password($code)
    {
        $response = get_api_response('user/check/code/newPassword', 'GET', [], ['code' => $code]);
        if($response->code != 200)
            return redirect('user/make/newPassword');

        $response = get_api_response('user/info');

        return view('user/make_new_password')
                    ->with('user', $response->data)
                    ->with('menu', 'account')
                    ->with('active', 'change_password');
    }

    public function change_password()
    {
        $response = get_api_response('user/info');
        
        if($response->data->password_make == 0)
            $template = "user/send_code_make_password";
        else
            $template = "user/password";

        return view($template)
                    ->with('user', $response->data)
                    ->with('menu', 'account')
                    ->with('active', 'change_password');
    }

    public function change_password_store()
    {
        $response = get_api_response('user/change/password', 'POST', [], $_POST);
        if($response->code != 200 )
        {
            Session::flash('message-fail', 'password gagal diganti');
            return redirect('account/change_password');
        }

        Session::flash('message-success', 'password berhasil diganti');
        return redirect('account/change_password');
    }

    public function top_menu()
    {
    	$response = get_api_response('user/info');
    	$html = "";
    	if(isset($response->data))
    		$html = view('layout.ajax_top_menu')->with(['data' => $response->data])->render();
                	
    	return response()->json(['html' => $html]);
    }

    public function profile_edit()
    {
        $response = get_api_response('user/info');
        return view('user/profile_edit')->with('user', $response->data)->with('menu', 'account');
    }

    public function address_store()
    {
        $primary = isset($_POST['primary']) ? $_POST['primary'] : 0;
        $_POST['primary'] = $primary;
        $response = get_api_response('user/address/add', 'POST', [], $_POST);
        return response()->json($response->code);
    }

    public function profile_edit_store(Request $request)
    {
        $birth = explode("-", $request->birth_date);
        if(count($birth) < 2)
            $result_date = date('Y-m-d');
        else
            $result_date = $birth[2]."-".$birth[1]."-".$birth[0];

        $data["name"] = $request->name;
        $data["birth"] = $result_date;
        $data["username"] = $request->username;
        $data["gender"] = (int) $request->gender;

        $response = get_api_response('user/profile/edit', 'POST', [], $data);
        return response()->json($response->code);
    }

    public function profile_image_change(Request $request)
    {
        $image = $request->file('file');
        $primary = Image::make($image)->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->encode('jpg');
        $thumbnail = Image::make($image)->resize(50,50)->encode('jpg');
        $imageFileName = 'profile-'.rand(0, 100000).time() . '.jpg';
        $s3 = \Storage::disk('s3');
        $s3->put('user/profile/'.$imageFileName, $primary->getEncoded(), 'public');
        $s3->put('user/profile/thumbnail/'.$imageFileName, $thumbnail->getEncoded(), 'public');

        $response = get_api_response('user/profile/image/change', 'POST', [], ['image' => $imageFileName]);
        return response()->json($response->code);
    }

    public function check_email(Request $request)
    {
        $response = get_api_response('user/check/email', 'POST', [], $_POST);
        if($response->code == 200 And $response->data->exist == false)
            return response()->json(false);

        return response()->json(true);
    }

    public function check_username(Request $request)
    {
        $response = get_api_response('user/check/username', 'POST', [], $_POST);
        
        if($response->code != 200)
            return response()->json(false);

        return response()->json(true);
    }

    public function validation($code)
    {
        $response = get_api_response('user/check/validation', 'POST', [], ['validation_code' => $code]);
        if($response->code != 200)
            return redirect('home') ;
        else{
            return view('user.change_data')->with('user', $response->data);
        }
    }

    public function validation_store(Request $request)
    {
        $data["name"] = $request->name;
        $data["birth"] = $request->birth;
        $data["phone"] = $request->phone;
        $data["gender"] = (int) $request->gender;
        $data["image"] = $request->new_image ? $request->new_image : $request->older_image;
        $data["password"] = $request->password ? $request->password : "";

        $response = get_api_response('user/profile/edit/validation', 'POST', [], $data);

        if($response->code != 200){
            $response = get_api_response('user/info');
            return view('user/info')->with('user', $response->data)->with('menu', 'account')->with('error_message', $response->message);
        }

        return redirect('account');
    }
}
