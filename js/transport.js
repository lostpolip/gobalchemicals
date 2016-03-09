$( document ).ready(function() {	
	$('#row-truck').hide();
	$('#row-employee').hide();

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

	$('#ddEmployee').change(function(){

		var employeeID = $('#ddEmployee').val();
		$.ajax({
			url: "transportEmployee.php", 
			method: "GET",
			data: { 
				employeeID : employeeID 
			},
			success: function(result){
				$('#txtTelEmployee').empty();

		    	var detailEmployee = jQuery.parseJSON(result);

		    	for (var x in detailEmployee['name']) {
					$('#txtTelEmployee').append('<input type="text" value=" '+detailEmployee['tel'][x]+' ">');
				}
				$('#row-employee').show();
				
		    }
		});
	});

	function recalculate(){
	    var sum = 0;
	    $("input[type=checkbox]:checked").each(function(){
	      sum += parseInt($(this).data('unitproduct'));
	    });
		$('#txtWeightProduct').val(sum); 
	}
		
	$(function(){
	    $('#example').click(function(){	         
	        recalculate()
	    });
	});

});