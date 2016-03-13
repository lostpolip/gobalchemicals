$( document ).ready(function() {
	$('#row-truck').hide();
	$('#row-employee').hide();
	$('#truckInfo').hide();

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

	$("input[name='destination[]'").on('change', function() {
		var sum = 0;
	    $("input[type=checkbox]:checked").each(function(){
	      sum += parseInt($(this).data('unitproduct'));
	    });
		$('#txtWeightProduct').val(sum);

		if ($('#txtWeightProduct').val() > 21) {
			alert('น้ำหนักสินค้าเกิน ไม่สามารถบรรทุกสินค้าได้');
			return false;
		}
		else if ($('#txtWeightProduct').val() > 20) {
			$('#txtTruck').val('21');
		} else if ($('#txtWeightProduct').val() > 10) {
			$('#txtTruck').val('20');
		} else if($('#txtWeightProduct').val() > 7) {
			$('#txtTruck').val('10');
		} else if($('#txtWeightProduct').val() > 2) {
			$('#txtTruck').val('7');
		}else{
			$('#txtTruck').val('2');
		}
		var truckWeight = $('#txtTruck').val();
		$.ajax({
			url: "transportTruck.php", 
			method: "GET",
			data: { 
				truckWeight : truckWeight 
			},
			success: function(result){
		    	
				$('#txtTruckType').empty();
				$('#txtTruckName').empty();
				$('#txtFuel').empty();
				$('#txtTruckWeight').empty();
				$('#txtTruckCapacity').empty();

		    	var detailTruck = jQuery.parseJSON(result);
		    	for (var x in detailTruck['weightcapacity']) {
					$('#txtTruckType').append('<input type="text" value=" '+detailTruck['trucktype'][x]+' ">');
					$('#txtTruckName').append('<input type="text" value=" '+detailTruck['name'][x]+' ">');
					$('#txtFuel').append('<input type="text" value=" '+detailTruck['fuel'][x]+' ">');
					$('#txtTruckWeight').append('<input type="text" value=" '+detailTruck['truckweight'][x]+' ">');
					$('#txtTruckCapacity').append('<input type="text" value=" '+detailTruck['weightcapacity'][x]+' ">');
					

				}
				$('#row-truck').show();
				
		    }
		});

		if ($('#txtWeightProduct').val() > 0) {
			$('#truckInfo').show();
			$('#btnCF').prop("disabled", false);
		} else {
			$('#truckInfo').hide();
			$('#btnCF').prop("disabled", true);
		}
	});


	$("input[name='rdoDate']").change(function(){
	if (this.id == 'rdoDate1') {
		var timeaction = $("#rdoDate1").val();
	} else {
		var timeaction = $("#rdoDate2").val();
	}
	$.ajax({
		url: "transportTimeAction.php", 
		method: "GET",
		data: { 
			timeaction : timeaction,
			datetransport : $('#txtDateTransport').val(),
		},
		success: function(result){
			console.log(result);

			}
	    });
	});

});