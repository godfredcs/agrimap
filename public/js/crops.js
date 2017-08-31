var Crops = {
	init: function()
	{
		Crops.registerEventListeners();
	},

	loadEditFields: function(id)
	{
		$.ajax({
	        type: 'get',
	        url : '/admin/crops/' + id,
	        success: function(response){
	        	$('#crop-name-update-box').val(response.name);
	        	$('#crop-description-update-box').val(response.description);
	        	$('#crop-edit-form').attr('action', '/admin/crops/' + id);

	        	$('#update-crop').modal('show');
		    }
	    });
	},

	addCrop: function(form)
	{
		App.submitForm(form, Crops.refreshCrops, $('#crop-add-errors-container'));
	},

	updateCrop: function(form)
	{
		App.submitForm(form, Crops.refreshCrops, $('#crops-update-errors-container'));
	},

	deleteCrop: function(form)
	{
		App.submitForm(form, Crops.refreshCrops);
	},

	refreshCrops: function()
	{
		NProgress.start();

		$.ajax({
	        type: 'get',
	        url : '/admin/crops',
	        success: function(response){
		        $('#crops-container').html(response);
		    }
	    }).always(function () {
			NProgress.done();
		});	
	},

	registerEventListeners: function()
	{
		$(document).on('click', '.update-crop', function(){
			var id = $(this).attr('data-id');
			Crops.loadEditFields(id);
		});

		$(document).on('submit', '#crop-add-form', function(e){
			e.preventDefault();
			Crops.addCrop(this);
		});

		$(document).on('submit', '#crop-edit-form', function(e){
			e.preventDefault();
			Crops.updateCrop(this);
		});

		$(document).on('click', '.delete-crop', function(e){
			e.preventDefault();
			var id = $(this).attr('data-id');
            
            $('.delete-form').attr('action', '/admin/crops/' + id);
            $('.delete-form').attr('id', 'crop-delete-form');
            App.showConfirmDialog("Do you want to delete this crop?");
		});

		$(document).on('submit', '#crop-delete-form', function(e){
			e.preventDefault();
			Crops.deleteCrop(this);
			App.hideConfirmDialog();
		});
	}
};

window.addEventListener('load', Crops.init);