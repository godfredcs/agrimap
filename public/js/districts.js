var Districts = {
	init: function()
	{
		Districts.registerEventListeners();
	},

	addDistrict: function(form)
	{
		App.submitForm(form,Districts.refreshDistricts,$('#district-add-errors-container'));
	},

	updateDistrict: function(form)
	{
		App.submitForm(form, Districts.refreshDistricts,$('#district-update-errors-container'));
	},

	loadEditFields: function(id)
	{
		$.ajax({
	        type: 'get',
	        url : '/districts/' + id,
	        success: function(response){
	        	var selectedRegion = [];
	        	var selectedCrops  = [];

	        	$.each(response.crops, function(index, value){
	        		selectedCrops.push(value.id);
	        	});

	        	selectedRegion.push(response.region_id);

	        	$('#district-name-update-box').val(response.name);
	        	$('#district-region-update-select').val(selectedRegion).change();
	        	$('#district-crops-update-select').val(selectedCrops).change();
	        	$('#district-edit-form').attr('action', 'districts/' + id);

	        	$('#update-district').modal('show');
		    }
	    });
	},

	refreshDistricts: function()
	{
		NProgress.start();

		$.ajax({
	        type: 'get',
	        url : '/districts',
	        success: function(response){
		        $('#districts-container').html(response);
		    }
	    }).always(function () {
			NProgress.done();
		});	
	},

	filterDistricts: function(form){
		var actionURL = $(form).attr('action');
		var formData = new FormData(form);

		NProgress.start();

		// Submit form via ajax
		$.ajax({
			url: actionURL, 
			type: 'POST',
			data: formData, 
			processData: false,
			contentType: false,
			cache: false,
			success: function (response) {
				$('#districts-container').html(response);
			},
			error: function(response){
                new PNotify({
					title: 'Error',
					text: "Failed to refresh table.",
					styling: 'bootstrap3',
					type: 'error',
					delay: 9500
				});
			}
	    }).always(function () {
			NProgress.done();
		});	
	},

	registerEventListeners: function()
	{
		$(document).on('click', '.update-district', function(){
			var id = $(this).attr('data-id');
			Districts.loadEditFields(id);
		});

		$(document).on('submit', '.districts-filter-form', function(e){
			e.preventDefault();
			Districts.filterDistricts(this);
		});

		$(document).on('submit', '#district-add-form', function(e){
			e.preventDefault();
			Districts.addDistrict(this);
		});

		$(document).on('submit', '#district-edit-form', function(e){
			e.preventDefault();
			Districts.updateDistrict(this);
		});
	}
};

window.addEventListener('load', Districts.init);