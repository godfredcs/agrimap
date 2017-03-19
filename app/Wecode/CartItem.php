<?php

namespace App\Wecode;

class CartItem
{ 
	/**
	 * @var String id generated for this order item
	 */
	public $id;

    /**
     * @var App\Models\Product the product related with this order
     *
     */
	public $product;

    /**
     * @var int quantity the quantity of the items ordered
     *
     */
	public $quantity;

    /**
     * @var decimal the price of this pizza ordered
     *
     */
    public $subtotal;

    /**
     * @var boolean controls whether the item is still part of the cart 
     *
     */
	public $active;


	public function __construct($params)
	{
		// Generate id for the order item using timestamp
        // This ID exists only during the lifetime of the cart
		$this->id = time();

		$this->product = $params['product'];
		$this->quantity = $params['quantity'];
		$this->subtotal = $params['subtotal'];
		$this->active = true;
	}
}