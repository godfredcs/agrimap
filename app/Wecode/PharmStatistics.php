<?php

namespace App\Wecode;

use App\Models\Sale;
use App\Models\Product;
use Carbon\Carbon;

class PharmStatistics
{
	/**
	 *  A class with static helper methods for retrieving statistics about the 
	 *  pharmacy for display on dashboard pages
	 */
	
	/**
	 * Get the sales that were made during this week
	 * 
	 * @return lluminate\Databae\Eloquent
	 */
	public static function getSalesThisWeek()
	{
		$startOfWeek = Carbon::now()->startOfWeek()->toDateString(); 
        $now = Carbon::now()->toDateTimeString();

		$orders = Sale::processed()->whereBetween('updated_at', [$startOfWeek, $now])->get();
        
        return $orders;
	}	

    /**
     * Get the total revenue today
     * 
     * @return Illuminate\Database\Eloquent
     */
	public static function getRevenueToday()
	{
		$total = 0;
		$salesToday = Sale::todays();

		foreach($salesToday as $sale){
			$total += $sale->total;
		}

		return $total;
	}

    /**
     * Get the total revenue made during this week of business
     * 
     * @return decimal the total revenue this week
     */
	public static function getRevenueInWeek()
	{
		$total = 0;

		$sales = self::getSalesThisWeek();

		foreach($sales as $sale){
			$total += $sale->total;
		}

		return $total;
	}

    /**
     * Get sales info for each day of the current week
     * 
     * @return array associative array containing days and corresponding sales
     */
	public static function getWeekDetails()
	{
		$sales = [];
		$start = Carbon::now()->startOfWeek();
		$end = Carbon::now()->endOfWeek();
		$salesThisWeek = self::getSalesThisWeek();
        
        $curr = $start;
        $data = [];
        
		while(true){
			$salesThisDay = [];

			foreach($salesThisWeek as $sale){
				$day = new Carbon($sale->updated_at);

				if($day->toDateString() == $curr->toDateString()){
					$salesThisDay[] = $sale;
				}
			}

			$sales[$curr->formatLocalized("%A")] = count($salesThisDay);

            if($curr->toDateString() == $end->toDateString())
            	break;

            $curr = $curr->addDay();
		}

		return $sales;
	}

    /**
     * Get a ranking of products sold during the week ranked
     * in decreasing order of sales
     * 
     * @return array associative array of products and their quantities sold
     */
	public static function getWeekPopularProducts()
	{
		$sales = self::getSalesThisWeek();
		$ranks = [];

		foreach($sales as $sale){
			foreach($sale->details as $detail){
				$ranks[$detail->product->name] = 0;
			}
		}

		foreach($sales as $sale){
			foreach($sale->details as $detail){
				$ranks[$detail->product->name] += $detail->quantity;
			}
		}
        
        arsort($ranks);

        return $ranks;
	}

	public static function getLowestStock()
	{
		$products = Product::orderBy('in_stock')->take(5)->get();
		$stocks = [];

		foreach($products as $product){
			$stocks[$product->name] = $product->in_stock;
		}
        
        $stocks = array_reverse($stocks);
		return $stocks;
	}
}