var AdmissionStatus = {
	Init: function () {
		
		AdmissionStatus.InitializeGauge();
	},

	InitializeGauge: function () {
	    var opts = {
	        lines: 24,
	        angle: 0,
	        lineWidth: 0.3,
	        pointer: {
	            length: 0.8,
	            strokeWidth: 0.04,
	            color: '#abd9ea'
	        },
	        limitMax: true,
	        colorStart: '#2A3F54',
	        colorStop: '#2A3F54',
	        strokeColor: '#F0F3F3',
	        generateGradient: true,
	        highDpiSupport: true
	    };

		var target          = document.getElementById('percentage-completed'),
		gauge               = new Gauge(target).setOptions(opts),
		currentStage        = document.querySelector('[name=current_stage]').value;
		percentageCompleted = (parseInt(currentStage) / 6) * 100;
		percentageCompleted = percentageCompleted === 0 ? 0.1 : percentageCompleted;

	    gauge.maxValue = 100;
	    gauge.animationSpeed = 32;
	    gauge.set(percentageCompleted);
	    gauge.setTextField(document.getElementById("gauge-text"));	
	}
};

window.addEventListener('load', AdmissionStatus.Init);