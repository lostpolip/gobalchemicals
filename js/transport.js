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
	$('#timeInfo').hide();
	$('#truckDetail').hide();

	$("input[name='destination[]'").on('change', function() {
		var sum = 0;
	    $("input[type=checkbox]:checked").each(function(){
	      sum += parseInt($(this).data('unitproduct'));
	    });
		$('#txtWeightProduct').val(sum);
		$('#timeInfo').show();
		$("#rdoDate1").trigger('click');
		// var weightContain = $('#txtWeightProduct').val();
		// var typeCar=[];
		// for (i = 0;weightContain > 0 ; i++) {
		// 	if (weightContain <= 2) {
		// 		weightContain = weightContain - 2;
		// 		typeCar[i] = 'รถกระบะคอก';
		// 	}
		// 	else if (weightContain <= 6) {
		// 		weightContain = weightContain - 6;
		// 		typeCar[i] = 'หกล้อตู้ทึบ';
		// 	}
		// 	else if (weightContain <= 10) {
		// 		weightContain = weightContain - 10;
		// 		typeCar[i] = 'หกล้อรถคอก';
		// 	} else if (weightContain <= 20) {
		// 		weightContain = weightContain - 20;
		// 		typeCar[i] = 'สิบล้อตู้ทึบ';
		// 	} else if(weightContain > 20) {
		// 		weightContain = weightContain - 21;
		// 		typeCar[i] = 'สิบล้อรถคอก';
		// 	}
		// }

		// for (x in typeCar) {
		// 	$('#truckDetail').show();
		//     $('#truckTypeDetail').append("<tr><td><label>ประเภทรถบรรทุกคันที่"+parseInt(x+1)+" :</label><label>"+ typeCar[x] +"</label></td></tr>");
		// }



		// var truckWeight = $('#txtTruck').val();
		// $.ajax({
		// 	url: "transportTruck.php", 
		// 	method: "GET",
		// 	data: { 
		// 		truckWeight : truckWeight 
		// 	},
		// 	success: function(result){
		//     	var arrResult = JSON.parse(result);
		//     	$('#position').empty();
		// 	    $("#position").append("<option value=''>------ กรุณาเลือก ------</option>");

		//     	for (x in arrResult.ID) {
		// 		    $("#position").append("<option value='"+arrResult.ID[x]+"'>"+arrResult.name[x]+"</option>");
		// 		}

		// 		$('#row-truck').show();
				
		//     }
		// });

		// if ($('#txtWeightProduct').val() > 0) {
		// 	$('#truckInfo').show();
		// 	$('#btnCF').prop("disabled", false);
		// 	$('#rdoDate1').trigger('click');

		// } else {
		// 	$('#truckInfo').hide();
		// 	$('#btnCF').prop("disabled", true);
		// }
	});



	$("input[name='rdoDate']").click(function(){
		if (this.id == 'rdoDate1') {
			var timeaction = $("#rdoDate1").val();
		} else if (this.id == 'rdoDate2') {
			var timeaction = $("#rdoDate2").val();
		} else {
			var timeaction = $("#rdoDate3").val();
		}
		$.ajax({
			url: "searchTruck.php", 
			method: "GET",
			data: { 
				timeaction : timeaction,
				datetransport : $('#txtDateTransport').val(),
			},
			success: function(result){
				$('#truckOther').empty();
				var TruckOther = jQuery.parseJSON(result);
			    	for (var x in TruckOther['name']) {
						// $('#truckOther').append('<option value="'+$.trim(TruckOther['ID'][x])+'">'+TruckOther['trucktype'][x]+'('+ TruckOther['weightcapacity'][x]	+'ตัน) | เลขทะเบียน: '+TruckOther['name'][x]+'</option>');
						$('#truckOther').append('<input type="checkbox" name="listTruckName[]"  value="'+ $.trim(TruckOther["ID"][x]) +'"'+ TruckOther['available'][x]+' > '+TruckOther['trucktype'][x]+'('+ TruckOther['weightcapacity'][x]	+'ตัน) | เลขทะเบียน: '+TruckOther['name'][x] +'<br>');
					}
				// id = jQuery.grep(jQuery.parseJSON(result).id, function(n, i){
				//   return (n !== "" && n != null);
				// });
				
				// text = jQuery.grep(jQuery.parseJSON(result).name, function(n, i){
				//   return (n !== "" && n != null);
				// });

				// $('#ddEmployee').append($('<option>', { 
				//         value: '',
				//         text : '--------กรุณาเลือก--------' 
				//     }));
				// $.each(text, function (i, item) {
				//     $('#ddEmployee').append($('<option>', { 
				//         value: id[i],
				//         text : text[i] 
				//     }));
			}
		});
	// $('#ddEmployee').empty();
	// $.ajax({
	// 	url: "transportTimeAction.php", 
	// 	method: "GET",
	// 	data: { 
	// 		timeaction : timeaction,
	// 		datetransport : $('#txtDateTransport').val(),
	// 	},
	// 	success: function(result){

	// 		id = jQuery.grep(jQuery.parseJSON(result).id, function(n, i){
	// 		  return (n !== "" && n != null);
	// 		});
			
	// 		text = jQuery.grep(jQuery.parseJSON(result).name, function(n, i){
	// 		  return (n !== "" && n != null);
	// 		});

	// 		$('#ddEmployee').append($('<option>', { 
	// 		        value: '',
	// 		        text : '--------กรุณาเลือก--------' 
	// 		    }));
	// 		$.each(text, function (i, item) {
	// 		    $('#ddEmployee').append($('<option>', { 
	// 		        value: id[i],
	// 		        text : text[i] 
	// 		    }));
	// 		});



	// 	}
 //    });

 //    $.ajax({
	// 	url: "truckRequestDetail.php", 
	// 	method: "GET",
	// 	data: { 
	// 		timeaction : $("input[name='rdoDate']:checked").val(),
	// 		datetransport : $('#txtDateTransport').val(),
	// 	},
	// 	success: function(result2){
	// 		var unavailableCar = jQuery.parseJSON(result2);
	// 		console.log(unavailableCar);
	// 		$("#position option").each(function()
	// 		{
	// 		    console.log($(this).val());
 //        		if (!jQuery.inArray($(this).val(),unavailableCar)) {
	//     			$(this).prop('disabled', true);
			   	 	
	//     		} else {
	//     			$(this).prop('disabled', false);
	//     		}
	// 		});
	// 		// $("#position").append("<option value=''>------ กรุณาเลือก ------</option>");

	//   //   	for (x in arrResult.ID) {
	//   //   		// console.log(arrResult.ID[x]);
	//   //   		// console.log(unavailableCar);
	//   //   		if (jQuery.inArray(arrResult.ID[x],unavailableCar)) {
	// 		//    	 	$("#position").append("<option value='"+arrResult.ID[x]+"'>"+arrResult.name[x]+"</option>");
	//   //   		} else {
	//   //   			$("#position").append("<option value='"+arrResult.ID[x]+"' disabled>"+arrResult.name[x]+"</option>");
	//   //   		}
	// 		// }

	// 		$('#row-truck').show();

 //    			}
 //    });


	});

	// $('#position').change(function () {
		
	// 	$('#truckDetail').show();

	// 	var truckDetail = $('#position').val(); 
	// 	$.ajax({
	// 		url: "searchTruck.php", 
	// 		method: "GET",
	// 		data: { 
	// 			truckDetail : truckDetail 
	// 		},
	// 		success: function(result){
	// 			$('#txtTruckType').empty();
	// 			$('#txtFuel').empty();
	// 			$('#txtTruckWeight').empty();
	// 			$('#txtTruckCapacity').empty();
			
	// 	    	var detailTruck = jQuery.parseJSON(result);
	// 	    	for (var x in detailTruck['weightcapacity']) {
	// 				$('#txtTruckType').append('<input type="text" value=" '+detailTruck['trucktype'][x]+' ">');
	// 				$('#txtFuel').append('<input type="text" value=" '+detailTruck['fuel'][x]+' ">');
	// 				$('#txtTruckWeight').append('<input type="text" value=" '+detailTruck['truckweight'][x]+' ">');
	// 				$('#txtTruckCapacity').append('<input type="text" value=" '+detailTruck['weightcapacity'][x]+' ">');	
	// 				$('#txtTruckID').append('<input type="text" id="hiddenTruckID" name="hiddenTruckID" value=" '+detailTruck['ID'][x]+' ">');	

	// 			}
	// 		}
	// 	});
	// });
});