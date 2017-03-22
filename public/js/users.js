var Users = {
	Init: function () {
	},

	Add: function(element) {
		var modal = $(element).parents('.modal');
		var form  = $(element).parents('form');
		var url   = form.attr('action');
		var data  = form.serialize();
		
		NProgress.inc(0.01);

		$.post(url, data, function(response) {
			if (response && response.errors) {
				new PNotify({
					title: 'Error',
					text: "Sorry, something unexpected occurred. Check errors on form.",
					styling: 'bootstrap3',
					type: 'error'
				});

                var errorHtml = App.buildErrorHtml(response.errors);

                modal.find('.error-container ul').html(errorHtml);
                modal.find('.alert-danger').removeClass('hidden')
                	.delay(10000).queue(function () {
						$(this).addClass('hidden').dequeue();
					});
			} else {
				new PNotify({
					title: 'Success',
					text: "User account been added successfully.",
					styling: 'bootstrap3',
					type: 'success'
				});

				modal.modal('hide');

				Users.RefreshPage();	
			}	
		}).always(function() {
			NProgress.done();
		});
	},

	InitiateUpdate: function (element) {
		var user_id = $(element).attr('data-id');
		var modal   = 'div.modal#edit';
		var passwordFields = $(modal).find('.password-fields');

		// Requesting for the details through a GET request with the id as a wildcard
		$.get('/users/' + user_id, function(response) {
			var user = response;

			$(modal + ' input[name=username]').val(user.username);
			$(modal + ' input[name=name]').val(user.name);
			$(modal + ' select[name=role_id]').val(user.role_id);
			$(modal + ' select[name=status_id]').val(user.status_id);
		});

		//Setting the form's action with user's id
		var url = 'http://' + window.location.host + '/users/' + user_id;
		$('div.modal#edit form').attr('action', url);
	},

	Update: function(element) {
		var modal = $(element).parents('.modal');
		var form  = $(element).parents('form');
		var url   = form.attr('action');
		var data  = form.serialize();

		NProgress.inc(0.01);

		$.post(url, data, function (response) {
			if (response && response.errors) {
				new PNotify({
					title: 'Error',
					text: "Sorry, something unexpected occurred. Check errors on form.",
					styling: 'bootstrap3',
					type: 'error'
				});

                var errorHtml = App.buildErrorHtml(response.errors);

                modal.find('.error-container ul').html(errorHtml);
                modal.find('.alert-danger').removeClass('hidden')
                	.delay(10000).queue(function () {
						$(this).addClass('hidden').dequeue();
					});
			} else {
				new PNotify({
					title: 'Success',
					text: "User account has been updated successfully.",
					styling: 'bootstrap3',
					type: 'success'
				});

				modal.modal('hide');

				Users.RefreshPage();
			}
		}).always(function() {
			NProgress.done();
		});
	},

	/**
	 * This is used toggle the edit function on my accounts page. This changes 
	 * the value of the handler [default: EDIT ACCOUNT] to suit the current 
	 * operation. It also hides or shows the edit form.
	 */
	EnableUserEdit: function (element) {
		// Toggling the hidden class on the editables
		$('.editable').toggleClass('hidden');

		if ($('input#name').attr('disabled')) {
			$('input#name').removeAttr('disabled');
		} else {
			$('input#name').attr('disabled', true);
		}

		if ($('input#email').attr('disabled')) {
			$('input#email').removeAttr('disabled');
		} else {
			$('input#email').attr('disabled', true);
		}

		// Changing the value of the handler
		if ($(element).val() == 'EDIT ACCOUNT') {
			$(element).val('CANCEL EDIT');	
		} else {
			$(element).val('EDIT ACCOUNT');	
		}

		if ($('.password_editable').hasClass('hidden') === false) {
			$('.password_editable, .validate_user').addClass('hidden');
			$('input#change_password').val('CHANGE LOGIN CREDENTIALS');	
		}
	},

	noteUsernameChange: function()
	{
		alert('Hello');
		$("input#username_edited").val(true);
	},

	/**
	 * This function takes care of the change password functionlaity on the 
	 * my accounts page. It toggles the hidden class on the password_editable 
	 * classes and also changes the value and classes of the handler
	 */
	EnableChangePassword: function (element) {
		if ($('input#username').attr('disabled')) {
			$('input#username').removeAttr('disabled');
		} else {
			$('input#username').attr('disabled', true);
		}

		$('.password_editable').toggleClass('hidden');

		if ($(element).val() == 'CHANGE LOGIN CREDENTIALS') {
			$(element).val('CANCEL LOGIN CREDENTIALS UPDATE');	
		} else {
			$(element).val('CHANGE LOGIN CREDENTIALS');	
		}
		
		if($('.password_editable').is(":visible")) {
			$('.validate_user').removeClass("hidden");
		}else{
			$('.validate_user').addClass("hidden");
		}
	},

	/**
	 * This is the function used to filter the users table. It uses the function getRowsFromData
	 * to re-populate the users table upon the filters chosen.
	 */
	FilterTable: function (element) {
		var parameters = {
			'role': $('select[name=role]').val(),
			'status': $('select[name=status]').val()
		}

		NProgress.inc(0.01);

		$.get('/users', parameters, function(response) {
            $('#users-table-wrapper').html(response);

			NProgress.done();
		});
	},

	/**
	 * This is the function for adding the form action to the delete box. It is used
	 * to delete a user from the database.
	 */
	InitiateDelete: function (element) {
		var id  = $(element).attr('data-id');
		var url = 'http://' + window.location.host + '/users/' + id;

		$('div.modal#delete form').attr('action', url);
	},

	Delete: function(element) {
		var modal = $(element).parents('.modal');
		var form  = $(element).parents('form');
		var url   = form.attr('action');
		var data  = form.serialize();

		NProgress.inc(0.01);

		$.post(url, data, function (response) {
			if (response && response.errors) {
				new PNotify({
					title: 'Error',
					text: "Sorry, something unexpected occurred. Check errors on form.",
					styling: 'bootstrap3',
					type: 'error'
				});

                var errorHtml = App.buildErrorHtml(response.errors);

                modal.find('.error-container ul').html(errorHtml);
                modal.find('.alert-danger').removeClass('hidden')
                	.delay(10000).queue(function () {
						$(this).addClass('hidden').dequeue();
					});
			} else {
				new PNotify({
					title: 'Success',
					text: "User account has been deactivated successfully.",
					styling: 'bootstrap3',
					type: 'success'
				});

				modal.modal('hide');

				Users.RefreshPage();
			}
		}).always(function() {
			NProgress.done();
		});
	},

	RefreshPage: function () {
		NProgress.inc(0.01);

		$.get('/users', function(response) {
			$('#users-table-wrapper').html(response);
		}).always(function() {
			NProgress.done();
		});
	}
};

// Initializing the init function
Users.Init();