<?php

namespace App\Http\Controllers;

use App\Models\Region;
use Illuminate\Http\Request;

class RegionsController extends Controller
{
	/**
	 * Show the landing page for managing regions
	 * 
	 * @return Illuminte\Http\Response
	 */
	public function index()
	{
		$regions = Region::all();
		return view('regions.index', compact('regions'));
	}

	public function store(Request $request)
	{
		$this->validate($request,['name' => 'required']);

    	Region::create($request->all());
    	return redirect()->back()->with('status', 'Region added succesfully');
	}

	public function show($id, Request $request)
	{
		$region = Region::find($id);

		if($request->ajax()){
			return $region;
		}
	}

	public function update($id, Request $request)
	{
		$this->validate($request, ['name' => 'required']);

		$region = Region::find($id);
		$region->update(['name' => $request->name ]);

		return redirect()->back()->with('status', 'Region has been updated succesfully');
	}
}
