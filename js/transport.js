$( document ).ready(function() {	
	$('#row-truck').hide();

	$('#ddTruck').change(function(){

		var truckID = $('#ddTruck').val();
		$.ajax({
			url: "transportTruck.php", 
			method: "GET",
			data: { 
				truckID : truckID 
			},
			success: function(result){
				$('#txtTruckType').empty();
				$('#txtTruckName').empty();
				$('#txtFuel').empty();
				$('#txtTruckWeight').empty();
				$('#txtTruckCapacity').empty();

		    	var detailTruck = jQuery.parseJSON(result);

		    	for (var x in detailTruck['name']) {
					$('#txtTruckType').append('<input type="text" value=" '+detailTruck['trucktype'][x]+' ">');
					$('#txtTruckName').append('<input type="text" value=" '+detailTruck['name'][x]+' ">');
					$('#txtFuel').append('<input type="text" value=" '+detailTruck['fuel'][x]+' ">');
					$('#txtTruckWeight').append('<input type="text" value=" '+detailTruck['truckweight'][x]+' ">');
					$('#txtTruckCapacity').append('<input type="text" value=" '+detailTruck['weightcapacity'][x]+' ">');
					

				}
				$('#row-truck').show();
				
		    }
		});
	});
});