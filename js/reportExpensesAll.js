$( document ).ready(function() {
	$('#total').hide();
	
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
    			var totalExpenses = 0;
				for (var i = 0; i < expenses.length; i++) {
				    totalExpenses += parseInt(expenses[i]);
				}

				$('#labelPrice').text(totalExpenses);
				$('#total').show();	

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
