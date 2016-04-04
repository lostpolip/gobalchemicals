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
	$('#truckInfo').hide();
	$('#employeeInfo').hide();


	$("input[name='destination[]'").on('change', function() {
		var sum = 0;
	    $("input[type=checkbox]:checked").each(function(){
	      sum += parseInt($(this).data('unitproduct'));
	    });
		$('#txtWeightProduct').val(sum);
		$('#timeInfo').show();
		$("#rdoDate1").trigger('click');
	});



	$("input[name='rdoDate']").click(function(){
		$('#truckInfo').show();
		$('#employeeInfo').hide();

		if (this.id == 'rdoDate1') {
			var timeaction = $("#rdoDate1").val();
		// } else if (this.id == 'rdoDate2') {
		// 	var timeaction = $("#rdoDate2").val();
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

					$('#truckOther').append('<input type="checkbox" name="listTruckName[]" data-weight-capacity="'+ $.trim(TruckOther["weightcapacity"][x]) +'" data-available="'+ TruckOther["available"][x] +'" id="'+ $.trim(TruckOther["ID"][x]) +'" value="'+ $.trim(TruckOther["ID"][x]) +'"'+ TruckOther['available'][x]+' > '+'<label for="'+ $.trim(TruckOther["ID"][x]) +'">'+TruckOther['trucktype'][x]+'('+ TruckOther['weightcapacity'][x]	+'ตัน) | เลขทะเบียน: '+TruckOther['name'][x] +'</label><br>');
				}

				$("input[name='listTruckName[]']").change(function() {
					var minimum = $('#txtWeightProduct').val();
					var count=0;
					$("input[name='listEmployeeName[]']").each(function() {
						$(this).attr('checked', false);

						if ($(this).data('available') !=  'disabled') {
							$(this).prop('disabled', false);
						}
					});
					$("input[name='listTruckName[]']:checked").each(function() {
						count = count + $(this).data('weight-capacity');
					});

					if (count >= minimum) {
						$('#employeeInfo').show();
						$("input[name='listTruckName[]']").each(function() {
							if(!$(this).is(':checked')) {
								$(this).prop('disabled', true);
							}
						});
					}	else {
							$('#employeeInfo').hide();

							$("input[name='listTruckName[]']").each(function() {
								if ($(this).data('available') !=  'disabled') {
									$(this).prop('disabled', false);
								}
							});
						}
				});
			}
		});

		$.ajax({
			url: "searchEmployee.php", 
			method: "GET",
			data: { 
				timeaction : timeaction,
				datetransport : $('#txtDateTransport').val(),
			},
			success: function(result){
				$('#employeeOther').empty();
				var EmployeeOther = jQuery.parseJSON(result);

		    	for (var x in EmployeeOther['name']) {
					
					$('#employeeOther').append('<input type="checkbox" name="listEmployeeName[]" data-available="'+ EmployeeOther["available"][x]+'" id="'+ $.trim(EmployeeOther["ID"][x]) +'" value="'+ $.trim(EmployeeOther["ID"][x]) +'"'+ EmployeeOther["available"][x]+' > '+'<label for="'+ $.trim(EmployeeOther["ID"][x]) +'">'+EmployeeOther['name'][x] +'</label><br>');
				}

				$("input[name='listEmployeeName[]']").change(function() {
					var minimumCar = $('#txtWeightProduct').val();
					var countCar=0;
					var countEmployee=0;
					$("input[name='listTruckName[]']:checked").each(function() {
						countCar++;
					});
					$("input[name='listEmployeeName[]']:checked").each(function() {
						countEmployee++;
					});

					if (countEmployee == countCar) {
						$("input[name='listEmployeeName[]']").each(function() {
							if(!$(this).is(':checked')) {
								$(this).prop('disabled', true);
							}
						});
					} else {
						$("input[name='listEmployeeName[]']").each(function() {
							if ($(this).data('available') !=  'disabled') {
								$(this).prop('disabled', false);
							}
						});
					}
				});
			}
		});
	});



	$('#btnCF').click(function(){
		var minimumCar = $('#txtWeightProduct').val();
		var countWeightCar=0;
		var countCar = 0;
		var countEmployee = 0;

		$("input[name='listTruckName[]']:checked").each(function() {
			countWeightCar = countWeightCar + $(this).data('weight-capacity');
			countCar++;
		});

		$("input[name='listEmployeeName[]']:checked").each(function() {
			countEmployee++;
		});

		if (countWeightCar >= minimumCar && countEmployee == countCar) {
			$( "#transportAddForm" ).submit();	
		}	else if(countEmployee < countCar) {
			alert("กรุณาเลือกพนักงานขับรถเพิ่ม")
		} else {
			alert("น้ำหนักรถที่เลือก ไม่เหมาะสมกับน้ำหนักสินค้า")
		}

	});
});