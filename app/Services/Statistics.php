<?php

namespace App\Services;

use DB;
use Carbon\Carbon;

use App\Models\SiteVisit;

class Statistics
{
    public static function getVisitorsCountThisWeek()
    {
        $count = 0;

        $startOfWeek = Carbon::now()->startOfWeek(); 
        $now = Carbon::now();
        $curr = $startOfWeek;
        $counts = [];


        while (true) {
	    $visitsForDay = count(SiteVisit::whereRaw(' time_visited = "'.$curr->toDateString().'"')->get());

	    $count += $visitsForDay;

	    if ($curr->toDateString() == $now->toDateString()) {
		break;
	    }

	    $curr = $curr->addDay();
	}
    }

    public function getVistorsThisWeek()
    {
    }
}