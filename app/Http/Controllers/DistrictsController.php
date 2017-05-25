<?php

namespace App\Http\Controllers;

use App\Models\Crop;
use App\Models\Region;
use App\Models\District;

use Illuminate\Http\Request;

class DistrictsController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest', ['only' => 'website']);
    }

    public function website()
    {
        $districts = District::paginate(20);
        return view('website.districts.index', compact('districts'));
    }

    public function index(Request $request)
    {
    	$districts = District::orderBy('name')->paginate(5);
    	$regions = Region::all();
        $crops = Crop::all();

        if($request->ajax()){
            return view('districts.table', compact('districts', 'regions', 'crops'));
        }

    	return view('districts.index', compact('districts', 'regions', 'crops'));
    }

    public function store(Request $request)
    {
    	$this->validate($request,  ['name' => 'required']);

    	$district = new District(['name' => $request->name ]);
    	$region = Region::find($request->region_id);

    	$region->districts()->save($district);

        $message = 'District has been added succesfully';

        if($request->ajax()){
            return json_encode(['message' => $message]);
        }

    	return redirect()->back()->with('status', $message);
    }

    public function show($id, Request $request)
    {
        $district = District::with('crops')->find($id);

        if($request->ajax()){
            return $district;
        }
    }

    public function update($id, Request $request)
    {
        $this->validate($request, ['name' => 'required']);

        $district = District::find($id);
        $district->update(['name' => $request->name, 'region_id' => $request->region_id]);

        if($request->crop_ids){
            $district->crops()->sync($request->crop_ids);
        }

        $message = 'District has been updated succesfully';

        if($request->ajax()){
            return json_encode(['message' => $message]);
        }

        return redirect()->back()->with('status', $message);
    }

    public function filter(Request $request)
    {
        $regionId = $request->region_id;
        $cropId   = $request->crop_id;
        $filtered = [];

        if($cropId == '0'){
            $tempDistricts = District::all();
        }
        else{
            $tempDistricts = Crop::find($cropId)->districts;
        }

        if($regionId == '0'){
            $filtered = $tempDistricts;
        }
        else{
            foreach($tempDistricts as $temp){
                if($temp->region_id == $regionId){
                    $filtered[] = $temp;
                }
            }
        }


        $districts = $filtered;

        if($request->ajax()){
            return view('districts.table', compact('districts'));
        }
    }

    public function search(Request $request)
    {
        $this->validate($request, ['name' => 'required']);

        $districts = District::where('name', 'like', '%'.$request->name.'%')->get();

        if($request->ajax()){
            return view('districts.table', compact('districts'));
        }
    }
}
