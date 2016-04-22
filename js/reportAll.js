function addCommas(nStr)
{
	nStr += '';
	x = nStr.split('.');
	x1 = x[0];
	x2 = x.length > 1 ? '.' + x[1] : '.00' ;
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
			url: "graphExtend.php", 
			method: "GET",
			data: { 
				startdate : startDate,
				enddate : endDate
			},
			success: function(result){
				$('#table').show();
				$('#tablebody').empty();
				
    			var date = jQuery.parseJSON(result).date.split(',');
    			var price = jQuery.parseJSON(result).price.split(',');	
    			var cost = jQuery.parseJSON(result).cost.split(',');

    			var totalPrice = 0;
    			var totalCost = 0;
    			var totalProfit = 0;
    			var Profit = 0;
				for (var i = 0; i < price.length; i++) {
 					Profit = parseFloat(price[i]-cost[i]);
						$('#tablebody').append("<tr> <th scope='row' style='text-align:center;'>"+parseFloat(i+1)+"</th><td style='text-align:center;'>"+formatDate(date[i])+"</td> <td style='text-align:right;'>"+addCommas(Math.round(price[i]*100)/100)+"</td> <td style='text-align:right;'>"+addCommas(Math.round(cost[i]*100)/100)+"</td> <td style='text-align:right;'>"+addCommas(Math.round(Profit*100)/100)+"</td> </tr> ");
				    totalPrice += parseFloat(price[i]);
				    totalCost += parseFloat(cost[i]);
				    totalProfit = parseFloat(totalPrice-totalCost);
				   
				}
				$('#table').DataTable();

				$('#labelPrice').text(addCommas(Math.round(totalPrice*100)/100));
				$('#labelCost').text(addCommas(Math.round(totalCost*100)/100));
				$('#labelProfit').text(addCommas(Math.round(totalProfit*100)/100));
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
				            data: cost,
				        }

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
