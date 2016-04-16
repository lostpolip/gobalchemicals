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



	$("input[name='rdoDate']").click(function(){
		$('#truckInfo').show();
		$('#employeeInfo').hide();
		$('#truckOther').html('');
		$('#employeeInfo').show();


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
				datetransport : $('#txtDateTransport').val()
			},
			success: function(result){
				var TruckOther = jQuery.parseJSON(result);

		    	for (var x in TruckOther['name']) {
					$('#truckOther').append('<input type="radio" name="listTruckName" data-weight-capacity="'+ $.trim(TruckOther["weightcapacity"][x]) +'" data-available="'+ TruckOther["available"][x] +'" id="'+ $.trim(TruckOther["ID"][x]) +'" value="'+ $.trim(TruckOther["ID"][x]) +'"'+ TruckOther['available'][x]+' > '+'<label for="'+ $.trim(TruckOther["ID"][x]) +'">'+TruckOther['trucktype'][x]+'('+ TruckOther['weightcapacity'][x]	+'ตัน) | เลขทะเบียน: '+TruckOther['name'][x] +'</label><br>');
				}

				$("input[name='listTruckName']").change(function() {
					var weightCar = $("input[name='listTruckName']:checked").val();

					$.ajax({
						url: "searchOrder.php", 
						method: "GET",
						data: { 
							weightCar : weightCar,
						},
						success: function(result){
							console.log(jQuery.parseJSON(result));
						}
					});

					
				});
			}
		});

		$.ajax({
			url: "searchEmployee.php", 
			method: "GET",
			data: { 
				timeaction : timeaction,
				datetransport : $('#txtDateTransport').val()
			},
			success: function(result){
				$('#employeeOther').empty();
				var EmployeeOther = jQuery.parseJSON(result);

		    	for (var x in EmployeeOther['name']) {
					
					$('#employeeOther').append('<input type="radio" name="listEmployeeName" data-available="'+ EmployeeOther["available"][x]+'" id="'+ $.trim(EmployeeOther["ID"][x]) +'" value="'+ $.trim(EmployeeOther["ID"][x]) +'"'+ EmployeeOther["available"][x]+' > '+'<label for="'+ $.trim(EmployeeOther["ID"][x]) +'">'+EmployeeOther['name'][x] +'</label><br>');
				}
			}
		});
	});

	$('#rdoDate1').trigger('click');

	$('#txtDateTransport').change(function(){
		$('#rdoDate1').trigger('click');
	});

	$('#btnCF').click(function(){

	});
});