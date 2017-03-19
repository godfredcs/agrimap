var Settings = {
	modal: $('.modal#item-modal'),

	init: function() {
		Settings.registerEventListeners();
	},

	prepModal: function(action, rel) {
		var heading;
		var buttonDescription;
		var modal = Settings.modal;
		var form = modal.find('form');

		if (rel === 'dosage_forms') {
			heading = action + ' New Dosage Form';
			buttonDescription = action + ' Dosage Form';
		} else {
			heading = action + ' New Classification';
			buttonDescription = action + ' Classification';
		}

		modal.find('#item-modal-header').text(heading);
		modal.find('#item-modal-submit-button').text(buttonDescription);

		form[0].reset();
		form.attr('action', '/settings?rel=' + rel);
		form.attr('data-rel', rel);
		form.find('[name=_method]').attr('disabled', 'disabled');
	},

	submit: function() {
		var form = Settings.modal.find('form');

		App.submitForm(form[0], Settings.refresh, Settings.modal.find('.error-container'));
	},

	delete: function() {
		var form = $('#confirm-dialog form');

		App.submitForm(form[0], Settings.refresh, form.find('.error-container'));
	},

	getData: function(id, rel) {
		var url = '/settings/' + id + '?rel=' + rel;
		var form = Settings.modal.find('form');

		NProgress.start();

		$.get(url, function (response) {
			form.attr('action', url);
			form.find('#name').val(response.name);
			form.find('[name=_method]').removeAttr('disabled');
	    }).always(function () {
	    	NProgress.done();
	    });
	},

	refresh: function() {
		var rel         = Settings.modal.find('form').attr('data-rel') || $('#confirm-dialog form').attr('data-rel');
		var containerId = '#' + rel.replace('_', '-') + '-container';
		var url         = '/settings?rel=' + rel;

		NProgress.start();

		$.get(url, function(response) {
			Settings.modal.modal('hide');

	        $(containerId).html(response);
		}).always(function () {
			NProgress.done();
		});
	},

	registerEventListeners: function()
	{
		$(document).on('click', '.add-item', function(e) {
			var rel = $(this).attr('data-rel');

			Settings.prepModal('Add', rel);
		});

		$(document).on('click', '.update-item', function(e) {
			var rel = $(this).parents('tbody').attr('data-rel');
			var id  = $(this).attr('data-id');

			Settings.prepModal('Update', rel);
			Settings.getData(id, rel);
		});

		$(document).on('submit', '.modal#item-modal form', function(e) {
			e.preventDefault();
			Settings.submit();
		});

		$(document).on('submit', '#settings-delete-form', function(e) {
			e.preventDefault();
			Settings.delete();
		});

		$(document).on('click', '.delete-item', function(e) {
			var id     = $(this).attr('data-id');
			var rel    = $(this).parents('tbody').attr('data-rel');
			var action = '/settings/' + id + '?rel=' + rel;

            App.setDeleteForm(action, 'settings-delete-form', 'Delete Item', {'data-rel': rel});
            App.showConfirmDialog('Are you sure you want to delete this item?');	
		});
	}
};

window.addEventListener('load', Settings.init);