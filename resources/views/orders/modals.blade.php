<!-- Pop-up for starting a new order -->
<div class="modal" id="add-order">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">x</span>
                </button>

                <h4>New Order</h4>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                         <div id="cart-add-errors-container">
                            @include('partials.modal_errors')
                        </div>

                        <form method="POST" action="cart_items/add" id="cart-item-add-form">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="select2-wrapper">
    		                            <select name="category" class="form-control select2 select2-hidden-accessible category-filter" id="category-filter">
    		                            	<option value="0">All Product Categories</option>

    		                            	@foreach($classifications as $classification)
    		                            	    <option value="{{ $classification->id }}">{{ $classification->name }}</option>
    		                            	@endforeach
    		                            </select>
                                    </div>
		                        </div>
	                        </div>

                            <div class="row margin-top">
                                <div class="col-md-6">
                                    <label>Product:</label>

                                    <div class="select2-wrapper">
	                                    <select name="product_name" class="form-control select2 select2-hidden-accessible product-name" id="product-name">
	                                        @foreach($products as $product)
	                                            <option value="{{$product->name}}">{{ $product->name }}</option>
	                                        @endforeach
	                                    </select>
	                                </div>
                                </div>

                                <div class="col-md-6">
                                    <label>Quantity:</label>
                                    <input type="text" name="quantity" class="form-control">
                                </div>
                            </div>

                            <div class="row margin-top">
                                <div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3">
                                    <button type="submit" class="btn btn-md btn-block btn-primary">Add Item</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="row margin-top">
                    <div class="col-lg-12 col-md-12">
                        <div id="cart-items-container">
                            @include('orders.items_table')
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <form method="POST" action="/orders" id="order-add-form">
                    {{ csrf_field() }}
                    <input type="hidden" name="items_count" id="items-count" value="0">
	                <div class="row">
	                    <div class="col-lg-6 col-md-6 col-sm-6">
	                        <button type="submit" class="btn btn-primary btn-block">Confirm Order</button>
	                    </div>

	                    <div class="col-lg-6 col-md-6 col-sm-6">
	                        <button type="button" class="btn btn-default btn-block" data-dismiss="modal">Cancel</button>
	                    </div>
	                </div>
	            </form>
            </div>
        </div>
    </div>
</div>

<!-- Pop up for editing cart items -->
<div class="modal" id="update-cart-item">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                Update Cart Item
            </div>
            
           <form action="/cart_items/update" method="POST" id="cart-item-update-form">
                {{ csrf_field() }}
                <input type="hidden" name="item_id" value="" id="item-id-field">

                <div class="modal-body">
                    <div id="cart-update-errors-container">
                        @include('partials.modal_errors')
                    </div>

                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                           <div class="form-group">
                               <label for="quantity">Quantity</label>
                               <input type="text" name="quantity" class="form-control" id="quantity-field"> 
                           </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <div class="row">
                        <div class="col-lg-5 col-md-5 col-sm-5 col-lg-offset-1 col-md-offset-1 col-sm-offset-1">
                            <button type="submit" class="btn btn-primary btn-block">Update</button>
                        </div>

                        <div class="col-lg-5 col-md-5 col-sm-5">
                            <button type="button" class="btn btn-default btn-block" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
           </form>
        </div>
    </div>
</div>

<!-- Popup for processing sale -->
<div class="modal" id="add-sale">
    <div class="modal-dialog">
        <div class='modal-content'>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">x</span>
                </button>

                <h4>New Sale</h4>
            </div>
            
            <form method="POST" action="" id='sales-form'>
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <input type="hidden" name="action_type" value="sale">
                <input type="hidden" name="status" value="PROCESSED">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div id="sale-errors-container">
                                @include('partials.modal_errors')
                            </div>

                            <div class="form-group">
                                <label>Order ID:</label>
                                <input type="text" class="form-control" name="order_id" id="order-id-field"  required>
                            </div>

                            <div>
                                 <table class="table table-bordered">
                                     <thead>
                                         <tr>
                                             <td>Item</td>
                                             <td>Quantity</td>
                                             <td>Subtotal</td>
                                         </tr>
                                     </thead>

                                     <tbody id="sales-items-container">
                                     </tbody>
                                 </table>

                                 <table class="table table-bordered">
                                     <tr>
                                         <td style="width: 50%">Total Amount Due: </td>
                                         <td>GHS <span id="order-total"></span></td>
                                     </tr>
                                 </table>
                            </div>
                            
                            <div class="form-group">
                                <label>Customer Name:</label>
                                <input type="text" class="form-control" name="customer_name" required>
                            </div>

                            <div class="form-group">
                                <label>Customer Contact:</label>
                                <input type="text" class="form-control" name="phone" required>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label>Amount Paid:</label>
                                        <input type="text" class="form-control" name="amount_paid" id="amount-paid-field">
                                    </div>
                                </div>
                                
                                <div class="col-lg-6  col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label>Change:</label>
                                        <input type="text" class="form-control" name="balance" id="change-due-field" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <div class="row">
                        <div class="col-lg-6 col-md-5 col-sm-6">
                            <button type="submit" class="btn btn-primary btn-block">Confirm Sale</button>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <button type="button" class="btn btn-default btn-block" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Pop-up modal for showing details of an order for update purposes -->
<div class="modal" id="order-details">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">x</span>
                </button>

                <h4 id="order-details-id"></h4>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                         <div id="orderitem-add-errors-container">
                            @include('partials.modal_errors')
                        </div>

                        <form method="POST" action="orders/add_item" id="order-item-add-form">
                            {{ csrf_field() }}
                            <input type="hidden" name="order_id" value="" id="order-id-field">
                            <input type="hidden" name="viewable_id" value="" id="order-viewable-id-field">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="select2-wrapper">
                                        <select name="category" class="form-control select2 select2-hidden-accessible category-filter" id="category-filter">
                                            <option value="0">All Product Categories</option>

                                            @foreach($classifications as $classification)
                                                <option value="{{ $classification->id }}">{{ $classification->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row margin-top">
                                <div class="col-md-6">
                                    <label>Product:</label>

                                    <div class="select2-wrapper">
                                        <select name="product_id" class="form-control select2 select2-hidden-accessible product-name" id="product-name">
                                            @foreach($products as $product)
                                                <option value="{{$product->id}}">{{ $product->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label>Quantity:</label>
                                    <input type="text" name="quantity" class="form-control">
                                </div>
                            </div>

                            <div class="row margin-top">
                                <div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3">
                                    <button type="submit" class="btn btn-md btn-block btn-primary">Add Item</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="row margin-top">
                    <div class="col-lg-12 col-md-12" id="order-details-table-container">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Quantity</th>
                                    <th>Subtotal</th>
                                    <th style="width: 110px">Actions</th>
                                </tr>
                            </thead>

                            <tbody id="order-details-body">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <div class="col-lg-6 col-md-5 col-sm-6">
                    <button class="btn btn-primary btn-block">Done</button>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6">
                    <button type="button" class="btn btn-default btn-block" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Popup for editing quantities of order items of already saved orders -->
<div class="modal" id="update-order-item">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                Update Cart Item
            </div>
            
           <form action="/orders/" method="POST" id="orders-update-form">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <div class="modal-body">
                    <div id="order-update-errors-container">
                        @include('partials.modal_errors')
                    </div>

                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                           <div class="form-group">
                               <label for="quantity">Quantity</label>
                               <input type="text" name="quantity" class="form-control" id="quantity-field"> 
                           </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <div class="row">
                        <div class="col-lg-5 col-md-5 col-sm-5 col-lg-offset-1 col-md-offset-1 col-sm-offset-1">
                            <button type="submit" class="btn btn-primary btn-block">Update</button>
                        </div>

                        <div class="col-lg-5 col-md-5 col-sm-5">
                            <button type="button" class="btn btn-default btn-block" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
           </form>
        </div>
    </div>
</div>