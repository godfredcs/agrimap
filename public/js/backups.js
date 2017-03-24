Backups = {
	init: function(){
		Backups.registerEventListeners();
	},

	registerEventListeners: function(){
		$(document).on('submit', '#backups-form', function(e){
			e.preventDefault();
			$('backup-form-button').attr('value', 'Backing up data...');
			App.submitForm(this,Backups.refreshButtonLabel,null);
		});
	},

	refreshButtonLabel: function(){
		$(document).find('backup-form-button').attr('value', 'BACK UP DATABASE');
	}
};

window.addEventListener('load', Backups.init);