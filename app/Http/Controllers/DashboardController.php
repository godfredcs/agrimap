<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Crop;
use App\Models\District;
use Illuminate\Http\Request;
use App\Services\Statistics;

class DashboardController extends Controller
{
	public function index()
    {
    	$visitors = Statistics::getVisitorsCountThisWeek();
    	$admins = User::all();
    	$districts = District::all();
    	$crops = Crop::all();
        return view('dashboard.dashboard', compact('admins', 'districts', 'crops'));
    }

    public function getWeekDetails()
    {
    	return [
    	    'Mon' => 10,
    	    'Tue' => 20,
    	    'Wed' => 30,
    	    'Thu' => 40,
    	    'Fri' => 100,
    	    'Sat' => 10,
    	    'Sun' => 5
    	];
    }
}
