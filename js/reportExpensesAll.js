function addCommas(nStr)
{
	nStr += '';
	x = nStr.split('.');
	x1 = x[0];
	x2 = x.length > 1 ? '.' + x[1] : '';
	var rgx = /(\d+)(\d{3})/;
	while (rgx.test(x1)) {
		x1 = x1.replace(rgx, '$1' + ',' + '$2');
	}
	return x1 + x2;
}

function diffDate(startdate, enddate) {
	var start = new Date(startdate),
    end   = new Date(enddate),
    diff  = new Date(end - start),
    days  = diff/1000/60/60/24;

	return days;
}

function formatDate(date) {
	var arrayDate = date.split('-');

	return arrayDate[2]+'-'+arrayDate[1]+'-'+arrayDate[0];
}

$( document ).ready(function() {
	$('#total').hide();
	
	$('#btnView').click(function() {
		var startDate = $('#startDate').val();
		var endDate = $('#endDate').val();
		
		if (diffDate(startDate, endDate) < 0) {
			alert('กรุณาเลือกวันใหม่');
			return false;
		}

		$.ajax({
			url: "graphExpenses.php", 
			method: "GET",
			data: { 
				startdate : startDate,
				enddate : endDate
			},
			success: function(result){
	
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
				    Profit = parseFloat(expensesOrder[i]-expenses[i]);
				    $('#tablebody').append("<tr> <th scope='row' style='text-align:center;'>"+parseFloat(i+1)+"</th><td style='text-align:center;'>"+formatDate(date[i])+"</td> <td style='text-align:right;'>"+addCommas(Math.round(expensesOrder[i]*100)/100)+"</td> <td style='text-align:right;'>"+addCommas(Math.round(expenses[i]*100)/100)+"</td> <td style='text-align:right;'>"+addCommas( Math.round(Profit*100)/100)+"</td> </tr> ");
					totalExpenses += parseFloat(expenses[i]);
					totalExpensesOrder += parseFloat(expensesOrder[i]);
					totalProfit = parseFloat(totalExpensesOrder-totalExpenses);
				}

				
				$('#table').DataTable();

				$('#labelExpensesOrder').text(addCommas(Math.round(totalExpensesOrder*100)/100));
				$('#labelExpenses').text(addCommas(Math.round(totalExpenses*100)/100));
				$('#labelProfit').text(addCommas(Math.round(totalProfit*100)/100));
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
