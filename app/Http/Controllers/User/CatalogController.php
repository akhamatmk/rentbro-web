<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Session;

class CatalogController extends Controller
{
	public function add()
	{
		return view('catalog/add_recommendations');
	}

	public function store()
	{
		Session::flash('message-success', 'Sukses');
		return redirect('recomendation/catalog/add');
	}
}