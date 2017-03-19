var Application = {
	Init: function () {
		$(function() {
			var current_stage = parseInt($('#wizard input[name=current_stage]').val());

			// Smart Wizard
	        $('#wizard').smartWizard({
	        	selected: current_stage,
	        	transitionEffect: 'fade',
	        	enableFinishButton: true,
	        	keyNavigation: false,
	        	labelFinish: 'Save & Exit',
	        	onLeaveStep: Application.SubmitSectionForm,
	        	onShowStep: Application.SetPageLayout,
	        	onFinish: Application.SubmitSectionForm
	        });

	        $('.buttonNext').addClass('btn btn-lg btn-success pull-right');
	        $('.buttonPrevious').addClass('btn btn-lg btn-primary');
	        $('.buttonFinish').addClass('btn btn-lg btn-default');

	        $('select[name^=country_of]').each(function () {
	        	$(this).val($(this).data('value')).change();
	        });

	        // International Phone Numbers
	        $("input[type=tel]").intlTelInput({
	        	allowDropdown: true,
	        	autoPlaceholder: 'polite',
	        	initialCountry: 'gh',
	        	preferredCountries: ['gh'],
	        	formatOnDisplay: true,
	        	nationalMode: false,
	        	utilsScript: '/vendors/intl-tel-input/build/js/utils.js'
	        });

	        Application.StartEventListeners();
    	});
	},

	StartEventListeners: function () {
		$('.name-part').on('input', Application.SetFullName);
        $('#upload-photo-button').click(Application.TriggerPhotoUpload);
        $('[name=photo]').change(App.PreviewImage);
        $('form input, form textarea, form select').change(Application.ToggleShouldSave);
        $('.step-link').click(Application.NavigateMultistepForm);

        $('input[type=tel]').on('blur', Application.SetPhoneNumber);
        $('input[type=tel]').on('change', Application.SetPhoneNumber);
	},

	/**
	 * Set the full name value by concatenating surname, first name and other names
	 */
	SetFullName: function () {
		var surname    = $('[name=surname]').val().trim();
		var firstname  = $('[name=first_name]').val().trim();
		var othernames = $('[name=other_names]').val().trim();

		$('[name=full_name]').val(surname + ' ' + firstname + ' ' + othernames).change();
	},

	SetPhoneNumber: function () {
		var newValue = $(this).intlTelInput("getNumber");

		$(this).val(newValue);
	},

	/**
	 * Submit the form on the current step when next or save and exit is pressed.
	 * 
	 * @param object obj    
	 * @param object context
	 */
	SubmitSectionForm: function (obj, context) {
		// Get variable values
		var form          = $('div#step-' + context.fromStep + ' form');
		var AjaxURL       = form.attr('action');
		var formData      = new FormData(form[0]);
		var shouldSave    = form.find('[name=should_save]').val();
		var SmartWizard   = this;
		var isSaveAndExit = !(!!context.toStep);

		// If the button clicked was Previous, do nothing
		if (!isSaveAndExit && context.fromStep > context.toStep) {
			return true;
		}

		// Validate form		
		form.parsley().on('form:success', function () {
			// If changes were made
			if (shouldSave == 'true') {
				NProgress.inc(0.01);

				// Submit form via ajax
				$.ajax({
					url: AjaxURL, 
					type: 'POST',
					data: formData, 
					processData: false,
  					contentType: false,
					success: function (response) {						
						if (!response.errors) {
							form.find('[name=should_save]').val('false');

							// Update some UI info with personal info
							if (parseInt(context.fromStep) === 1) {
								form.find('[name=photo]').val('');
								$('.profile_info h2').text(response.title.name + ' ' + response.full_name);
							}

							if (isSaveAndExit) {
								window.location = '/';
							} else {
								SmartWizard.goToStep(context.toStep, true);
							}
						} else {
							var errorDiv = $('div.alert-danger');
							var errorsHTML = '';

							$.each(response.errors, function (i) {
								errorsHTML += '<li>' + response.errors[i] + '</li>';
							});

							errorDiv.find('ul').html(errorsHTML);
							errorDiv.removeClass('hidden');

							errorDiv.delay(10000).queue(function () {
								$(this).addClass('hidden').dequeue();
							});
						}
					}
				}).always(function () {
					NProgress.done();
				});
			} else {
				if (isSaveAndExit) {
					window.location = '/';
				} else {
					SmartWizard.goToStep(context.toStep, true);
				}
			}
		}).validate();

		return false;
	},

	/**
	 * Set the current active nav link and change the title of the page according 
	 * to the current active step
	 * 
	 * @param object obj    
	 * @param object context
	 */
	SetPageLayout: function (obj, context) {
		var title = $('#wizard a[rel=' + context.toStep + '] span.step_descr').text();
		var sidebar = $('#admissions-form-sidebar');

		sidebar.find('.active').removeClass('active');
		sidebar.find('li:nth-child(' + (context.toStep + 1) + ')').addClass('active');

		$('.page-title h1').text(title);
	},

	NavigateMultistepForm: function (event) {
		event.preventDefault();
		event.stopPropagation();

		var rel = $(this).attr('rel');
		var step = $('#wizard .wizard_steps a[rel=' + rel + ']');
		var activeStep = $('.step-link.active');

		if (!step.length) {
			return;
		}

		if (step.hasClass('disabled')) {
			return;
		}

		$('#wizard').smartWizard('goToStep', rel, true);

		activeStep.removeClass('active');
		step.addClass('active');
	},

	TriggerPhotoUpload: function () {
		$('[name=photo]').click();
	},
	
	ToggleShouldSave: function () {
		var shouldSaveField = $(this).parents('form').find('[name=should_save]');

		shouldSaveField.val('true');
	}
};

window.addEventListener('load', Application.Init);