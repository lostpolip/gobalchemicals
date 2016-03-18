$( document ).ready(function() {
	$('#btnView').click(function() {
		var startDate = $('#startDate').val();
		var endDate = $('#endDate').val();
		$.ajax({
			url: "graphExpenses.php", 
			method: "GET",
			data: { 
				startdate : startDate,
				enddate : endDate
			},
			success: function(result){
    			var date = jQuery.parseJSON(result).date.split(',');
    			var expenses = jQuery.parseJSON(result).expenses.split(',');	
				var ctx = $("#myChart").get(0).getContext("2d");
			    var data = {
			    	multiTooltipTemplate: "85858",
				    labels: date,
				    datasets: [
				        {
				            label: "ค่าใช้จ่าย",
				            fillColor: "rgba(164, 242, 119, 0.5)",
				            strokeColor: "rgba(220,220,220,1)",
				            pointColor: "rgba(215, 145, 6, 0.9)",
				            pointStrokeColor: "#fff",
				            pointHighlightFill: "#fff",
				            pointHighlightStroke: "rgba(220,220,220,1)",
				            data: expenses,
				        },
				        // {
				        //     label: "out",
				        //     fillColor: "rgba(208, 207, 96, 0.7)",
				        //     strokeColor: "rgba(220,220,220,1)",
				        //     pointColor: "rgba(208, 0, 55, 0.7)",
				        //     pointStrokeColor: "#fff",
				        //     pointHighlightFill: "#fff",
				        //     pointHighlightStroke: "rgba(220,220,220,1)",
				        //     data: cost
				        // }

				    ]
				};

			    var myNewChart = new Chart(ctx).Line(data,{
				   animation: true,
				   barValueSpacing : 5,
				   barDatasetSpacing : 1,
				   tooltipFillColor: "rgba(0,0,0,0.8)",                
				   multiTooltipTemplate: "<%= datasetLabel %> - <%= value %>"
			    });
		    }
		});
	});

});
