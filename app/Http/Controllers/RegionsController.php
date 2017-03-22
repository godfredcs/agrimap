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
	public function index(Request $request)
	{
		$regions = Region::all();

		if($request->ajax()){
			return view('regions.table', compact('regions'));
		}

		return view('regions.index', compact('regions'));
	}

	public function store(Request $request)
	{
		$this->validate($request,['name' => 'required']);

    	Region::create($request->all());
    	$message = 'Region added succesfully';
        
        if($request->ajax()){
        	return json_encode(['message' => 'Region has been added succesfully']);
        }
        
    	return redirect()->back()->with('status', $message);
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
