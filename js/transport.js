var claimAlert = function () {
	$.ajax({
		url: "alertClaim.php", 
		method: "GET",
		success: function(result){
			$('#txtClaim').text(result);
			$('#txtClaim').show();
			if (result == 0) {
				$('#txtClaim').hide();
			}
		}
	});
}

var orderAlert = function () {
	$.ajax({
		url: "alertOrder.php", 
		method: "GET",
		success: function(result){
			$('#txtOrder').text(result);
			$('#txtOrder').show();
			if (result == 0) {
				$('#txtOrder').hide();
			}
		}
	});
}



$( document ).ready(function() {

	claimAlert();
	orderAlert();
	setInterval(function(){ 
		claimAlert();
		orderAlert();
	}, 5000);

	
	$('#row-truck').hide();
	$('#row-employee').hide();
	$('#truckInfo').hide();

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
					$('#txtTruckID').append('<input type="text" id="hiddenTruckID" name="hiddenTruckID" value=" '+detailTruck['ID'][x]+' ">');	

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
	$('#ddEmployee').empty();
	$.ajax({
		url: "transportTimeAction.php", 
		method: "GET",
		data: { 
			timeaction : timeaction,
			datetransport : $('#txtDateTransport').val(),
		},
		success: function(result){
			id = jQuery.grep(jQuery.parseJSON(result).id, function(n, i){
			  return (n !== "" && n != null);
			});
			
			text = jQuery.grep(jQuery.parseJSON(result).name, function(n, i){
			  return (n !== "" && n != null);
			});

			$('#ddEmployee').append($('<option>', { 
			        value: '',
			        text : '--------กรุณาเลือก--------' 
			    }));
			$.each(text, function (i, item) {
			    $('#ddEmployee').append($('<option>', { 
			        value: id[i],
			        text : text[i] 
			    }));
			});

			}
	    });
	});

});