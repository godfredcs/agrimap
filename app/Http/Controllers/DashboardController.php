<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Crop;
use App\Models\District;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
	public function index()
    {
    	$admins = User::all();
    	$districts = District::all();
    	$crops = Crop::all();
        return view('dashboard.dashboard', compact('admins', 'districts', 'crops'));
    }
}
