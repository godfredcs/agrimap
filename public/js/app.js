var App = {
	Init: function() {
		$('.alert.fade-in').delay(10000).slideUp('fade-in');

		$('form').on('input', function (event) {
			if (event.keyCode == 13) {
				event.preventDefault();
				return false;
			}
		});

		let closeButtons = $('.modal div.alert-danger a[data-dismiss=alert]');

		closeButtons.removeAttr('data-dismiss');

		closeButtons.on('click', function (event) {
			event.preventDefault();
			$(this).parent().addClass('hidden');
		});
		
		// Select 2
		$(".select2").select2();
	},

	buildErrorHtml: function(errors)
	{
		var errorHtml = "";

        $.each(errors , function(key , value){
            errorHtml += "<li>" + value[0] + "</li>";
        });

        return errorHtml;
	},

	showConfirmDialog: function(message)
	{
		$('#confirm-dialog .modal-body p#delete-message').text(message);
        $('#confirm-dialog').modal('show');
	},

	hideConfirmDialog: function()
	{
		$('#confirm-dialog').modal('hide');
	},

	setDeleteForm: function(actionURL, referenceId, header, attributes)
	{
		var form = $('#confirm-dialog .delete-form');

		if (header) {
			form.find('#delete-dialog-header').text(header);
		}

		if (attributes) {
			$.each(attributes, function (attribute, value) {
				form.attr(attribute, value);
			});
		}

		form.attr('action', actionURL);
        form.attr('id', referenceId);
	},

	submitForm: function(form, callback, $errorContainer, hideModal = true)
	{
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
				var responseMsg = JSON.parse(response);

				new PNotify({
					title: 'Success',
					text: responseMsg.message,
					styling: 'bootstrap3',
					type: 'success'
				});
                
                if(hideModal){
				    $('.modal').modal('hide');
                }

				if (callback) {
					callback();
				}
			},

			error: function(response){
				if ($errorContainer) {
					var errors = response.responseJSON;
	                var errorHtml = App.buildErrorHtml(errors);

	                $errorContainer.find('ul').html(errorHtml);
	                $('.modal-error-div').removeClass('hidden')
	                	.delay(15000).queue(function () {
						$(this).addClass('hidden').dequeue();
					});
	            }
	            
 
                new PNotify({
					title: 'Error',
					text: "The form submission failed. Check form for specific details.",
					styling: 'bootstrap3',
					type: 'error',
					delay: 9500
				});
			}
	    }).always(function () {
			NProgress.done();
		});	
	},

	viewProduct: function(id)
	{
		alert(id);
		
		$.ajax({
	        type: 'get',
	        url : '/products/' + id,
	        success: function(response){
	        	console.log(response);
		        var product = JSON.parse(response);

                $('#product-view-heading').html(product.name);
                $('#product-view-description').html(product.description);
                $('#product-view-dosage-info').html(product.dosage_info);
		    }
	    });
	}
};

window.addEventListener('load', App.Init);