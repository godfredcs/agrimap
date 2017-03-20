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

	registerEventListeners: function()
	{
		$(document).on('click', '.update-region', function(){
			var id = $(this).attr('data-id');
			Regions.loadEditFields(id);
		});
	}
};

window.addEventListener('load', Regions.init);