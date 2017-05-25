<?php

namespace App\Http\Controllers;

use App\Models\Region;

use Illuminate\Http\Request;

class HomeController extends Controller
{	
	public function __construct()
	{
		$this->middleware('guest');
	}

    public function index() {
    	$regions = Region::all();
    	return view('website.home.index', compact('regions'));
    }
}
