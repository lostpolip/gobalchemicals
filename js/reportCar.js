function diffDate(startdate, enddate) {
	var start = new Date(startdate),
    end   = new Date(enddate),
    diff  = new Date(end - start),
    days  = diff/1000/60/60/24;

	return days;
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
			url: "graphCar.php", 
			method: "GET",
			data: { 
				startdate : startDate,
				enddate : endDate
			},
			success: function(result){
				$('#table').show();
				$('#tablebody').empty();
    			var date = jQuery.parseJSON(result).date.split(',');
    			var amount = jQuery.parseJSON(result).amount.split(',');	
    			var type = jQuery.parseJSON(result).type.split(',');

				for (var i = 0; i < amount.length; i++) {
					$('#tablebody').append("<tr> <th scope='row'>"+parseInt(i+1)+"</th><td>"+date[i]+"</td> <td>"+type[i]+"</td> <td>"+amount[i]+"</td> </tr> ");
				   
				}
				
				$('#table').DataTable();

				var ctx = $("#myChart").get(0).getContext("2d");
			    var data = {
			    	multiTooltipTemplate: "85858",
				    labels: type,
				    datasets: [
				        {
				            label: "income",
				            fillColor: "rgba(164, 242, 119, 0.5)",
				            strokeColor: "rgba(220,220,220,1)",
				            pointColor: "#000",
				            pointStrokeColor: "#fff",
				            pointHighlightFill: "#fff",
				            pointHighlightStroke: "rgba(220,220,220,1)",
				            data: amount,
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
