<?php $items = App\Wecode\Cart::getItems();?>
@if(count($items))
<table class="table table-bordered table-striped">
    <tr>
        <th style="width: 40%">Product</th>
        <th>Quantity</th>
        <th>Subtotal(GHS)</th>
        <th>Actions</th>
    </tr>
	    @foreach($items as $item)
	    <tr>
	        <td>{{ $item->product->name }}</td>
	        <td>{{ $item->quantity }}</td>
	        <td>{{ number_format($item->subtotal,2,'.', ',') }}</td>
	        <td>
	            <button class="btn btn-sm btn-success view-product" data-toggle="modal" data-target="#show-product" data-id="{{ $item->product->id }}" data-quantity="{{ $item->quantity }}"><i class="fa fa-eye"></i></button>

	            <button class="btn btn-sm btn-info cart-item-update" data-toggle="modal" data-target="#update-cart-item" data-id="{{ $item->id }}" data-quantity="{{ $item->quantity }}"><i class="fa fa-pencil"></i></button>

	            <button class="btn btn-sm btn-danger cart-item-delete" data-id="{{ $item->id }}"><i class="fa fa-trash-o"></i></button>
	        </td>
	    </tr>
	    @endforeach
</table>
@else
   <div class="well alert alert-danger">
       <p>No items in basket</p>
   </div>
@endif