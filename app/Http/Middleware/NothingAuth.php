<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class NothingAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
    	$response = get_api_response('user/info');
        $result = $response;
        if(isset($result->data->id))          
            return redirect('/');

        return $next($request);
    }
}
