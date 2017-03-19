<?php

namespace App\Http\Controllers;

use App\Models\Crop;
use Illuminate\Http\Request;

class CropsController extends Controller
{
    public function index()
    {
    	$crops = Crop::all();
    	return view('crops.index', compact('crops'));
    }

    public function store(Request $request)
    {
    	$this->validate($request,['name' => 'required']);

    	Crop::create($request->all());
    	return redirect()->back()->with('status', 'Crop added succesfully');
    }
}
