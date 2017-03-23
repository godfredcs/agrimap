<?php

namespace App\Http\Controllers;

use \COM;
use Illuminate\Http\Request;

class BackupsController extends Controller
{
    public function index()
    {
    	$drives = [];
		$fso = new COM('Scripting.FileSystemObject');

		foreach ($fso->Drives as $drive) {
		    $drives[] = $drive->DriveLetter;
		}
		 
		return view('backups.index', compact('drives'));
    }
}
