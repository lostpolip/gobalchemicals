$( document ).ready(function() {
	$('#btnView').click(function() {
		var startDate = $('#startDate').val();
		var endDate = $('#endDate').val();
		$.ajax({
			url: "graphExtend.php", 
			method: "GET",
			data: { 
				startdate : startDate,
				enddate : endDate
			},
			success: function(result){
    			var date = jQuery.parseJSON(result).date.split(',');
    			var price = jQuery.parseJSON(result).price.split(',');	
				var ctx = $("#myChart").get(0).getContext("2d");
			    var data = {
				    labels: date,
				    datasets: [
				        {
				            label: "My First dataset",
				            fillColor: "rgba(164, 242, 119, 0.5)",
				            strokeColor: "rgba(220,220,220,1)",
				            pointColor: "rgba(215, 145, 6, 0.9)",
				            pointStrokeColor: "#fff",
				            pointHighlightFill: "#fff",
				            pointHighlightStroke: "rgba(220,220,220,1)",
				            data: price
				        },

				    ]
				};

			    var myNewChart = new Chart(ctx).Line(data);
		    }
		});
	});

	// var ctx = $("#myChart").get(0).getContext("2d");
 //    var data = {
	//     labels: date,
	//     datasets: [
	//         {
	//             label: "My First dataset",
	//             fillColor: "rgba(220,220,220,0.2)",
	//             strokeColor: "rgba(220,220,220,1)",
	//             pointColor: "rgba(220,220,220,1)",
	//             pointStrokeColor: "#fff",
	//             pointHighlightFill: "#fff",
	//             pointHighlightStroke: "rgba(220,220,220,1)",
	//             data: income
	//         },

	//     ]
	// };

 //    var myNewChart = new Chart(ctx).Line(data);
});
