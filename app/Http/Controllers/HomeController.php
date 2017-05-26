<?php

namespace App\Http\Controllers;

use App\Models\Region;
use App\Models\SiteVisit;

use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{	
    public function index(Request $request) {
    	$regions = Region::all();
    	$ip = $request->ip();

    	$site_visit = SiteVisit::create([
    		'time_visited' => Carbon::now()->toDateString(),
    		'ip' => $ip
    	]);

    	return view('website.home.index', compact('regions'));
    }
}
