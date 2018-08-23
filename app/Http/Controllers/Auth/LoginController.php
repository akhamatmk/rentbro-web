<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Validator;
use Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';
    protected $authFor = 'login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index()
    {
        return view('auth/login');
    }

    public function check()
    {
        $response = get_api_response('user/login', 'POST', [], $_POST);
        if($response->code != 200)            
            return view('auth/login')->with('error_message', $response->message);
        
        return redirect('/');
    }

    public function register(Request $request)
    {
        if($request->type AND $request->email)
            return view('auth/register_by_email')->with('email', base64_decode($request->email));
        else
            return view('auth/register');
    }

    public function registerPost(Request $request)
    {
        $rules = [
            'email' => 'required'
        ];

        $validator = Validator::make(
            $request->all(),
            $rules
        );

        if ($validator->fails())
            return view('auth/register')->with('error_message', $validator->errors()->all());

        $url = 'register?type=email&email='.base64_encode($request->email);
        return redirect($url);
    }

    public function registerEmailPost()
    {
        $response = get_api_response('user/register', 'POST', [], $_POST);
        if($response->code != 200)
            return view('auth/register')->with('error_message', $response->message);
        else
            return redirect('home');
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect()->route('home');
    }

    public function redirectToProvider($provider, Request $request)
    {
        $forAuth = $request->input('authFor') ? $request->input('authFor') : null;
        if(isset($forAuth))        
            $request->session()->put('state_form', 'login');
        else
            $request->session()->put('state_form', 'register');

        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider, Request $request)
    {
        $authFor = $request->session()->get('state_form');
        $user = Socialite::driver($provider)->stateless()->user();
        $request->session()->forget('state_form');
        
        if($authFor == 'register'){
            $response = get_api_response('user/register/'.$provider, 'POST', [], $user);
            if($response->code != 200)
                return view('auth/login')->with('error_message', $response->message);
            else
                return redirect('home');
        }
        else if($authFor == 'login'){
            $response = get_api_response('user/login/with/'.$provider, 'POST', [], $user);
            if($response->code != 200)
                return view('auth/register')->with('error_message', $response->message);
            else
                return redirect('home');
        }else
            return redirect('home');
    }
}
