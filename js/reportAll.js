$( document ).ready(function() {
	$('#total').hide();

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
    			var cost = jQuery.parseJSON(result).cost.split(',');
    			var totalPrice = 0;
    			var totalCost = 0;
				for (var i = 0; i < price.length; i++) {
				    totalPrice += parseInt(price[i]);
				    totalCost += parseInt(cost[i]);
				}
				$('#labelPrice').text(totalPrice);
				$('#labelCost').text(totalCost);
				$('#total').show();
				var ctx = $("#myChart").get(0).getContext("2d");
			    var data = {
			    	multiTooltipTemplate: "85858",
				    labels: date,
				    datasets: [
				        {
				            label: "income",
				            fillColor: "rgba(164, 242, 119, 0.5)",
				            strokeColor: "rgba(220,220,220,1)",
				            pointColor: "#000",
				            pointStrokeColor: "#fff",
				            pointHighlightFill: "#fff",
				            pointHighlightStroke: "rgba(220,220,220,1)",
				            data: price,
				        },
				        {
				            label: "outcome",
				            fillColor: "rgba(208, 207, 96, 0.7)",
				            strokeColor: "rgba(220,220,220,1)",
				            pointColor: "#fff",
				            pointStrokeColor: "#fff",
				            pointHighlightFill: "#fff",
				            pointHighlightStroke: "rgba(220,220,220,1)",
				            data: cost
				        }

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
