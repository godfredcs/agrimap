var Crops = {
	init: function()
	{
		Crops.registerEventListeners();
	},

	loadEditFields: function(id)
	{
		$.ajax({
	        type: 'get',
	        url : '/crops/' + id,
	        success: function(response){
	        	$('#crop-name-update-box').val(response.name);
	        	$('#crop-description-update-box').val(response.description);
	        	$('#crop-edit-form').attr('action', 'crops/' + id);

	        	$('#update-crop').modal('show');
		    }
	    });
	},

	registerEventListeners: function()
	{
		$(document).on('click', '.update-crop', function(){
			var id = $(this).attr('data-id');
			Crops.loadEditFields(id);
		});
	}
};

window.addEventListener('load', Crops.init);