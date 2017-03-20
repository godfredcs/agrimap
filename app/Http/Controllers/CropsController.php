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

    public function show($id, Request $request)
    {
        $crop = Crop::find($id);

        if($request->ajax()){
            return $crop;
        }
    }

    public function update($id, Request $request)
    {
        $this->validate($request, ['name' =>'required']);

        $crop = Crop::find($id);
        $crop->update(['name' => $request->name, 'description' => $request->description ]);

        return redirect()->back()->with('status', 'Crop has been updated succesfully');
    }
}
