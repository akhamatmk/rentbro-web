<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function show_ajax($id, Request $request)
    {
        $response = get_api_response('catalogue/'.$id);
        return response()->json($response->data);
    }

}
