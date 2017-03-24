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

    public function backup(Request $request)
    {
    	$drive =  $request->drive;

    	$server_name   = "localhost";
		$username      = "root";
		$password      = "";
		$database_name = "agrimap";
		$date_string   = date("Y_m_d_h_m_s");
		$path = $drive.":/agrimap_backups/agrimap_".$date_string.".sql";

        if (!file_exists($drive.':/agrimap_backups')){
            mkdir($drive.':/agrimap_backups', 0777, true); 
        }

    	$cmd = exec("C:/xampp/mysql/bin/mysqldump --routines -h {$server_name} -u {$username} {$database_name} > ". $path, $output, $return);

        if(!$return){
            $message = 'Backup has completed succesfully';
        } 
        else{
            $message = 'Backup failed to complete';
        }
        
        if($request->ajax()){
        	return json_encode(['message' => $message]);
        }

    	return redirect()->back()->with('status', $message);
    }

    public function restore(Request $request)
    {
        if($request->file('sql_file')){
            $fileName = 'restore.sql';
            $request->file('sql_file')->move(base_path().'/storage/',$fileName);
        }

        $server_name   = "localhost";
        $username      = "root";
        $password      = "";
        $database_name = "agrimap";   
        $path = base_path().'/storage/restore.sql';

        $cmd = exec("C:/xampp/mysql/bin/mysql -h {$server_name} -u {$username} {$database_name} < " 
            . $path, $output, $return);

        if(!$return){
            $message = 'Database has been restored with loaded data';
        } 
        else{
            $message = 'Database could not be restored';
        }

        if($request->ajax()){
            return json_encode(['message' => $message]);
        }

        return redirect()->back()->with('status', $message);
    }
}
