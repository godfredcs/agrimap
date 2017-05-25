<?php

namespace App\Http\Controllers;

use App\Models\Region;
use Illuminate\Http\Request;

class RegionsController extends Controller
{
	public function __construct()
	{
		$this->middleware('guest', ['only' => 'website']);
	}

	/**
	 * Display all regions
	 * @return [view] [description]
	 */
	public function website()
	{
		$regions = Region::all();
		return view('website.regions.index', compact('regions'));
	}

	/**
	 * Show a specific region
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function regions($id)
	{
		$region = Region::with(['districts', 'crops'])->find($id);
		return view('website.regions.show', compact('region'));
	}

	/**
	 * Show the landing page for managing regions
	 * 
	 * @return Illuminte\Http\Response
	 */
	public function index(Request $request)
	{
		$regions = Region::all();

		if($request->ajax()){
			return view('regions.table', compact('regions'));
		}

		return view('regions.index', compact('regions'));
	}

    /**
     * Add a new region to the database
     * 
     * @param  Illuminate\Http\Request the form request
     * @return Illuminate\Http\Response
     */
	public function store(Request $request)
	{
		$this->validate($request,['name' => 'required|unique:regions,name'],
			['name.unique' => 'Region already exists']);

    	Region::create($request->all());
    	$message = 'Region added succesfully';
        
        if($request->ajax()){
        	return json_encode(['message' => 'Region has been added succesfully']);
        }
        
    	return redirect()->back()->with('status', $message);
	}

    /**
     *  Load and return a region
     *  
     * @param  int  $id the id of the region
     * @param  Illuminate\Http\Request $request the HTTP request to load resource
     * @return Illuminate\Http\Response the HTTP response
     */
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
        
        $message = 'Region has been updated succesfully';

        if($request->ajax()){
        	return json_encode(['message' => $message]);
        }

		return redirect()->back()->with('status', $message);
	}

	public function destroy($id, Request $request)
	{
		$region = Region::find($id);
		$region->delete();

		$message = 'Region has been removed succesfully';

		if($request->ajax()){
			return json_encode(['message' => $message]);
		}

		return redirect()->back()->with('status', $message);
	}
}
