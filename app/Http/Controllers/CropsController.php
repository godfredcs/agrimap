<?php

namespace App\Http\Controllers;

use App\Models\Crop;
use Illuminate\Http\Request;

class CropsController extends Controller
{
    public function index(Request $request)
    {
    	$crops = Crop::all();

        if($request->ajax()){
            return view('crops.table', compact('crops'));
        }
        
    	return view('crops.index', compact('crops'));
    }

    public function store(Request $request)
    {
    	$this->validate($request,['name' => 'required']);

    	Crop::create($request->all());

        $message = 'Crop added succesfully';

        if($request->ajax()){
            return json_encode(['message' => $message]);
        }

    	return redirect()->back()->with('status', $message);
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
        
        $message = 'Crop has been updated succesfully';
        
        if($request->ajax()){
            return json_encode(['message' => $message]);
        }

        return redirect()->back()->with('status', $message);
    }

    public function destroy($id, Request $request)
    {
        $crop = Crop::find($id);
        $crop->delete();

        $message = 'Crop has been deleted succesfully';

        if($request->ajax()){
            return json_encode(['message' => $message]);
        }

        return redirect()->back()->with('status', $message);
    }
}
