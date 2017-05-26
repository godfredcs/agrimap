var Dashboard = {
	init: function()
	{
		Dashboard.drawWeeklySalesChart();
	},

    drawWeeklySalesChart: function()
    {
    	$.ajax({
	        type: 'get',
	        url : '/views/week_details',
	        success: function(response){
	        	var collection = [];
	        	console.log(response);

	        	$.each(response,function(key,value){
	        		collection.push({label: key,y: value});
	        	});

	        	console.log(collection);

	            var chart = new CanvasJS.Chart("views-this-week", {
				    title:{
				      text: "",
				      fontColor: "rgba(100,149,237)"              
				    },
				    axisY :{
				        lineColor: "#3CB371",
				        gridColor: "#F0FFFF", 
				        },
			        axisX :{
				        lineColor: "#3CB371",
				        gridColor: "#F0FFFF", 
			        },
				    data: [              
					    {
						     // Change type to "doughnut", "line", "splineArea", etc.
						    type: "splineArea",
						    dataPoints: collection
					    }
				    ]
				});
				chart.render();
			}
		});
    },

	registerEventListeners: function()
	{

	}
};

window.load = Dashboard.init();