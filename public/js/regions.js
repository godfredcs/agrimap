var Regions = {
	init: function()
	{
		Regions.registerEventListeners();
	},

	loadEditFields: function(id)
	{
		$.ajax({
	        type: 'get',
	        url : '/regions/' + id,
	        success: function(response){
	        	$('#region-name-update-box').val(response.name);
	        	$('#region-edit-form').attr('action', '/regions/' + id);

	        	$('#update-region').modal('show');
		    }
	    });
	},

	addRegion: function(form)
	{
		App.submitForm(form, Regions.refreshRegions, $('#region-add-errors-container'));
	},

	deleteRegion: function(form)
	{
		App.submitForm(form, Regions.refreshRegions);
	},

	updateRegion: function(form)
	{
		App.submitForm(form, Regions.refreshRegions);
	},

	refreshRegions: function()
	{
		NProgress.start();

		$.ajax({
	        type: 'get',
	        url : '/regions',
	        success: function(response){
		        $('#regions-container').html(response);
		    }
	    }).always(function () {
			NProgress.done();
		});	
	},

	registerEventListeners: function()
	{
		$(document).on('submit', '#region-add-form', function(e){
			e.preventDefault();
			Regions.addRegion(form);
		});

		$(document).on('click', '.update-region', function(){
			var id = $(this).attr('data-id');
			Regions.loadEditFields(id);
		});

		$(document).on('click', '.delete-region', function(e){
			e.preventDefault();
			var id = $(this).attr('data-id');
            
            $('.delete-form').attr('action', '/regions/' + id);
            $('.delete-form').attr('id', 'region-delete-form');
            App.showConfirmDialog("Do you want to delete this region?");
		});

		$(document).on('submit', '#region-edit-form', function(e){
			e.preventDefault();
			Regions.updateRegion(this);
		});

		$(document).on('submit', '#region-delete-form', function(e){
			e.preventDefault();
			Regions.deleteRegion(this);
			App.hideConfirmDialog();
		});
	}
};

window.addEventListener('load', Regions.init);