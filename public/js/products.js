var Products = {
	init: function()
	{
		Products.registerEventListeners();
	},

	addProduct: function(form)
	{
		App.submitForm(form, Products.refreshProducts, $('#products-add-errors-container'));
	},

	updateProduct: function(form)
	{
		App.submitForm(form, Products.refreshProducts, $('#products-update-errors-container'));
	},

	loadProductUpdateFields: function(id)
	{
		$.ajax({
	        type: 'get',
	        url : '/products/' + id,
	        success: function(response){
		        var product = JSON.parse(response);
                var selectedClassificationIds = [];
                var selectedDosageFormIds = [];

		        $.each(product.classifications, function(index, classification) {
		        	selectedClassificationIds.push(classification.id);
		        });

		        $.each(product.dosage_forms, function(index, dosage_form) {
		        	selectedDosageFormIds.push(dosage_form.id);
		        });
       
                $('#product-edit-form').attr('action', '/products/' + product.id);
		        $('#edit-name-field').val(product.name);
		        $('#edit-price-field').val(product.unit_price);
		        $('#edit-description-field').html(product.description);
		        $('#edit-dosage-field').html(product.dosage_info);
		        $('#edit-classifications').val(selectedClassificationIds).change();
		        $('#edit-dosage-forms').val(selectedDosageFormIds).change();

		        $('#edit-product').modal('show');
		    }
	    });
	},

	loadProductRestockFields: function(id)
	{
		$.ajax({
	        type: 'get',
	        url : '/products/' + id,
	        success: function(response){
		        var product = JSON.parse(response);

                $('#restock-form').attr('action', '/products/' + product.id);
                $('#restock-form').find('#product-name-field').val(product.name);
                $('#restock-form').find('#current-stock-field').val(product.in_stock);
		    }
	    });
	},

	refreshProducts: function(id)
	{
		$('#products-container').html("").addClass('loader-body');

		$.ajax({
	        type: 'get',
	        url : '/products',
	        success: function(response){
	        	$('#products-container').removeClass('loader-body');
		        $('#products-container').html(response);
		    }
	    });
	},

	deleteProduct: function(form)
	{
		App.submitForm(form, Products.refreshProducts);
	},

	restockProduct: function(form)
	{
		App.submitForm(form, Products.refreshProducts, $('#products-restock-errors-container'));
	},

	registerEventListeners: function()
	{
		$(document).on('click', '.restock', function(e){
			var id = $(this).attr('data-id');
			Products.loadProductRestockFields(id);
		});

		$(document).on('submit', '#product-add-form', function(e){
			e.preventDefault();
			Products.addProduct(this);
		});

		$(document).on('submit', '#product-edit-form', function(e){
			e.preventDefault();
			Products.updateProduct(this);
		});

		$(document).on('submit', '#restock-form', function(e){
			e.preventDefault();
			Products.restockProduct(this);
		});

		$(document).on('click', '.update-product', function(e){
			e.preventDefault();
			var id = $(this).attr('data-id');
            
            Products.loadProductUpdateFields(id);
		});

		$(document).on('click', '.delete-product', function(e){
			e.preventDefault();
			var id = $(this).attr('data-id');
            
            $('.delete-form').attr('action', '/products/' + id);
            $('.delete-form').attr('id', 'products-delete-form');
            App.showConfirmDialog("Do you want to delete this product?");	
		});

		$(document).on('submit', '#products-delete-form', function(e){
			e.preventDefault();
			Products.deleteProduct(this);
			App.hideConfirmDialog();
		});
	}
};

window.addEventListener('load', Products.init);