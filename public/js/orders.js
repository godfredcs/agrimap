var Orders = {
	init: function()
	{
		Orders.registerEventListeners();
	},

	addItem: function(form)
	{
		App.submitForm(form, Orders.refreshItems, $('#cart-add-errors-container'), false);
	},

	deleteItem: function(form)
	{
		App.submitForm(form, Orders.refreshItems);
	},

	updateItem: function(form)
	{
		App.submitForm(form, Orders.refreshItems, $('#cart-update-errors-container'));
	},

	saveOrder: function(form)
	{
		App.submitForm(form, Orders.refreshOrders, $('#cart-add-errors-container'));
	},

	filterProducts: function(id)
	{
		$.ajax({
	        type: 'get',
	        url : '/products/filter/' + id,
	        success: function(response){
	        	products = JSON.parse(response);

	        	var html = "";

	        	for(i = 0;i < products.length;i++){
	        		html += "<option value='" + products[i].id +"'>" + products[i].name + "</option>";
	        	}

	        	$('.product-name').html(html);
		    }
		});
	},

	refreshItems: function()
	{
		$container = $('#cart-items-container');
		$container.html("").addClass('loader-body');

		$.ajax({
	        type: 'get',
	        url : '/cart_items',
	        success: function(response){
	        	$container.removeClass('loader-body');
		        $container.html(response);
		    }
	    });
	},

	refreshOrders: function()
	{
		$container = $('#order-items-container');
		$container.html("").addClass("loader-body");

		$.ajax({
	        type: 'get',
	        url : '/orders',
	        success: function(response){
	        	$container.removeClass('loader-body');
		        $container.html(response);
		    }
	    });
	},

	loadOrderDetails: function(orderId)
	{
		$.ajax({
	        type: 'get',
	        url : '/orders/load/' + orderId,
	        success: function(response){
	        	var order = response.order;
                var details = response.details;

	        	var html = "";
	        	
	        	$.each(details, function(index, detail) {
	        	    var rowHtml = "<tr>\n<td>" + detail.product + 
	        	        "</td>\n<td>" + detail.quantity + "</td>\n<td>" + detail.subtotal + "</td></tr>\n";

	        	    html += rowHtml;
		        });


		        $('#sales-items-container').html(html);
		        $('#order-total').html(parseInt(order.total).toPrecision(3).toString());
	        	$('#sales-form').attr('action', '/orders/' + order.id);	        
		    }
	    });
	},

	populateOrderUpdateTable: function(orderId)
	{
		$.ajax({
	        type: 'get',
	        url : '/orders/load/' + orderId,
	        success: function(response){
	        	var order = response.order;
                var details = response.details;

	        	var html = "";
	        	
	        	$.each(details, function(index, detail) {
	        	    var rowHtml = "<tr>\n<td>" + detail.product + 
	        	        "</td>\n<td>" + detail.quantity + "</td>\n<td>" + detail.subtotal + "</td>"+

	        	        "<td><button class='btn btn-sm btn-info order-update-edit' data-id="+
	        	         detail.id +" data-quantity=" + detail.quantity + " data-order-id ="+
	        	         order.id + " data-toggle = 'modal' data-target='#update-order-item'>"+
	        	         "<i class='fa fa-pencil'></i></button>"+

	        	        "<button class='btn btn-sm btn-danger order-update-delete' data-id="+ 
	        	        detail.id +"><i class='fa fa-trash'></i></button></td>" +"</tr>\n";

	        	    html += rowHtml;
		        });


		       $('#order-details-id').html("Order " + order.viewable_id);
		       $('#order-details-body').html(html);
		       $('#order-item-add-form').find('#order-id-field').val(order.id);
		       $('#order-item-add-form').find('#order-viewable-id-field').val(order.viewable_id);
		    }
	    });
	},

	showChangeDue: function()
	{
		var amountPaid = $('#amount-paid-field').val();
		var total = parseInt($('#order-total').html());
		var changeDue = amountPaid - total; 

		$('#change-due-field').val("GHS " + changeDue.toPrecision(3).toString());
	},

	printReceipt: function(id)
	{
	    $.ajax({
	        type: 'get',
	        url: '/orders/receipt/' + id,
	        success: function(response){
	            var printWin = window.open('', '', 'width=' + 600 + ',height=' + 600 + ',left=' + 300
	            	+ ',top=' + 50);

	            printWin.document.write(response);
	            printWin.document.close();

	            printWin.addEventListener('load', function () {
                printWin.focus();
                printWin.print();
                printWin.close();
             });
	        }
	    });	
	},

	registerEventListeners: function()
	{
		$(document).on('submit', '#cart-item-add-form', function(e){
			e.preventDefault();
			Orders.addItem(this);
		});

		$(document).on('click', '.cart-item-delete', function(e){
			var id = $(this).attr('data-id');
            
            $(document).find('.delete-form').attr('action', '/cart_items/delete/' + id);
            $(document).find('.delete-form').attr('id', 'cart-items-delete-form');

            App.showConfirmDialog("Do you want to remove this product from basket?");
		});

		$(document).on('submit', '#cart-items-delete-form', function(e){
			e.preventDefault();

			App.hideConfirmDialog();
			Orders.deleteItem(this);
		});

		$(document).on('click', '.cart-item-update', function(e){
			e.preventDefault();
			var id = $(this).attr('data-id');
			var quantity = $(this).attr('data-quantity');
            
            $('#cart-item-update-form').find('#item-id-field').val(id);
            $('#cart-item-update-form').find('#quantity-field').val(quantity);
		});

		$(document).on('submit', '#cart-item-update-form', function(e){
			e.preventDefault();

			Orders.updateItem(this);			
		});

		$(document).on('submit', '#order-add-form', function(e){
			e.preventDefault();
			Orders.saveOrder(this);
		});

		$(document).on('change', '.category-filter', function(){
			Orders.filterProducts($(this).val());
		});

	    $(document).on('click', '.process-order:not(.disabled)', function(){
	    	var id = $(this).attr('data-id');
	    	$('#order-id-field').val(id).change();
	    });

		$(document).on('change', '#order-id-field', function(){
			var id = $(this).val();
			Orders.loadOrderDetails(id);
		});

		$(document).on('change', '#amount-paid-field', function(){
			Orders.showChangeDue();
		});

		$(document).on('submit', '#sales-form', function(e){
			e.preventDefault();
			App.submitForm(this, Orders.refreshOrders, $('#sale-errors-container'));
		});

		$(document).on('click', '.print-receipt:not(.disabled)', function(){
			var id = $(this).attr('data-id');
			Orders.printReceipt(id);
		});

		$(document).on('click', '.view-product', function(){
			var id = $(this).attr('data-id');
			App.viewProduct(id);
		});

		$(document).on('click', '.update-order', function(){
			var id = $(this).attr('data-id');
			Orders.populateOrderUpdateTable(id);
		});

		$(document).on('click','.delete-order', function(){
			var id = $(this).attr('data-id');
			var url = '/orders/' + id;
            
            App.setDeleteForm(url, 'order-delete-form', 'Delete Order');
			App.showConfirmDialog("Do you want to delete this order?");

		});

		$(document).on('submit', '#order-delete-form', function(e){
			e.preventDefault();
			App.submitForm(this,Orders.refreshOrders,null);
		});

		$(document).on('click', '.order-update-edit', function(){
			var id = $(this).attr('data-id');
			$('#orders-update-form').attr('action', '/sale_details/' + id);
		});

		$(document).on('click', '.order-update-delete', function(){
			var id = $(this).attr('data-id');
			var url = '/sale_details/' + id;
            
            App.setDeleteForm(url, 'order-items-delete-form', 'Delete Order Item');
			App.showConfirmDialog("Do you want to remove this item from order?");
		});

		$(document).on('submit', '#order-items-delete-form', function(e){
			e.preventDefault();
			var id = $('#order-item-add-form').find('#order-viewable-id-field').val();

			var afterAjax = function(){
				$('#order-details').modal('hide');
				Orders.populateOrderUpdateTable(id);
				$('#order-details').modal('show');
				Orders.refreshOrders();
			};

			App.submitForm(this,afterAjax,null);
		});

		$(document).on('submit', '#orders-update-form', function(e){
			e.preventDefault();
			App.submitForm(this,null,$('order-update-errors-container'),false);
		});

		$(document).on('submit', '#order-item-add-form', function(e){
			e.preventDefault();
			var id = $(this).find('#order-viewable-id-field').val();

			var afterAjax = function(){
				$('#order-details').modal('hide');
				Orders.populateOrderUpdateTable(id);
				$('#order-details').modal('show');
				Orders.refreshOrders();
			};

			App.submitForm(this,afterAjax,$('orderitem-add-errors-container'),false);
		}); 
	}
};

window.addEventListener('load', Orders.init);