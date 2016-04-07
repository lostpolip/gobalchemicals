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
				console.log(result);
				$('#table').show();
				$('#tablebody').empty();
								
    			var date = jQuery.parseJSON(result).dateOrder.split(',');
    			var expenses = jQuery.parseJSON(result).expenses.split(',');
    			var expensesOrder = jQuery.parseJSON(result).expensesOrder.split(',');
    			var totalExpenses = 0;
    			var totalExpensesOrder = 0;
    			var Profit = 0;
    			var totalProfit = 0;

				for (var i = 0; i < expenses.length; i++) {
				    Profit = parseInt(expensesOrder[i]-expenses[i]);
				    $('#tablebody').append("<tr> <th scope='row'>"+parseInt(i+1)+"</th><td>"+date[i]+"</td> <td>"+expensesOrder[i]+"</td> <td>"+expenses[i]+"</td> <td>"+Profit+"</td> </tr> ");
					totalExpenses += parseInt(expenses[i]);
					totalExpensesOrder += parseInt(expensesOrder[i]);
					totalProfit = parseInt(totalExpensesOrder-totalExpenses);
				}

				
				$('#table').DataTable();

				$('#labelExpensesOrder').text(totalExpensesOrder);
				$('#labelExpenses').text(totalExpenses);
				$('#labelProfit').text(totalProfit);
				$('#total').show();

				var ctx = $("#myChart").get(0).getContext("2d");
			    var data = {
			    	multiTooltipTemplate: "85858",
				    labels: date,
				    datasets: [
				        {
				            label: "รายได้ค่าขนส่ง",
				            fillColor: "rgba(164, 242, 119, 0.5)",
				            strokeColor: "rgba(220,220,220,1)",
				            pointColor: "rgba(215, 145, 6, 0.9)",
				            pointStrokeColor: "#fff",
				            pointHighlightFill: "#fff",
				            pointHighlightStroke: "rgba(220,220,220,1)",
				            data: expensesOrder,
				        },

				        {
				            label: "ค่าใช้จ่ายค่าขนส่ง",
				             fillColor: "rgba(208, 207, 96, 0.7)",
				            strokeColor: "rgba(220,220,220,1)",
				            pointColor: "#fff",
				            pointStrokeColor: "#fff",
				            pointHighlightFill: "#fff",
				            pointHighlightStroke: "rgba(220,220,220,1)",
				            data: expenses,
				        },

				    ]
				};

			    var myBarChart = new Chart(ctx).Bar(data,{
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
