<?php

namespace App\Wecode;

use Session;

class Cart
{
	/**
	 * Create a cart
	 */
	public static function initiate()
	{
		session(['cart' => array()]);
	}

    /**
     * Add an order item to the cart
     *
     * @param App\Helpers\CartItem item 
     * @return void
     */
	public static function addItem(CartItem $item)
	{
		$items = session('cart');
		$items[] = $item;

		session(['cart' => $items]);
		Session::save();
	}

    /**
     * Remove an item from the cart
     *
     * @param String $id 
     * @return void
     */
	public static function removeItem($id)
	{
		$items = session('cart');

		for($i = 0; $i < count($items); $i++){
			if($items[$i]->id == $id){
				$items[$i]->active = false;
			}
		}

		session(['cart' => $items]);
		Session::save();
	}

    /**
     * Return an array of items in the cart
     *
     * @return array an array of App\Helpers\CartItem objects
     */
	public static function getItems()
	{
		$items = array();

        foreach(session('cart') as $item){
        	if($item->active)
        		$items[] = $item;
        }

		return $items;
	}

    /**
     * Return a count of non-deleted items in cart
     *
     * @return int number of non-deleted items in the cart
     */
	public static function itemsCount()
	{
		$count = 0;
        $items = session('cart');

        if($items){
			foreach($items as $item){
				if($item->active)
					$count++;
			}
		}

		return $count;
	}

    /**
     * Locate and return the cart item with the given ID 
     *
     * @param string the ID of the cart item
     * @return App\Helpers\CartItem the cart item with the given ID
     */
	public static function find($id)
	{
		$items = self::getItems();

		foreach($items as $item){
			if($item->id == $id)
				return $item;
		}

		return null;
	}

    /**
     * Update properties of the cart item with the given ID
     *
     * @param string id the ID of the cart item to update
     * @param array data the properties to update with their correspnding values
     * @return null 
     */
	public static function update($id , $data)
	{
		$items = session('cart');

		foreach ($items as $item_key => $item) {
			if ($item->id == $id) {
				foreach ($data as $data_key => $value) {
					$items[$item_key]->$data_key = $value;
				}
			}
		}

		// for($i = 0; $i < count($items); $i++){
		// 	if($items[$i]->id == $id){
		// 		foreach($data as $key => $value){
		// 			$items[$i]->$key = $value;
		// 		}
		// 	}
		// }

		session(['cart' => $items]);
		Session::save();

		return;
	}

    /**
     * Get the total price of the items in cart
     *
     * @return App\Helpers\Money
     *
     */
	public static function getTotalPrice()
	{
		$total = 0;
		$items = session('cart');

		foreach($items as $item){
			if($item->active){
				$total += $item->subtotal;
			}
		}

		return $total;
	}

    /**
     * Remove all items from the cart
     *
     */
	public static function clear()
	{
		self::initiate();
	}
}