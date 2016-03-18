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

	$('#btnCF').click(function() {
		var patt= /[-+]?(\d*[.])?\d+/;

		if(!patt.test($('#txtTruckWeight').val())) {
	    	alert('กรุณากรอกน้ำหนักเป็นตัวเลข');
	    	return false;
		}

		if(!patt.test($('#txtTruckCapacity').val())) {
	    	alert('กรุณากรอกน้ำหนักเป็นตัวเลข');
	    	return false;
		}

		if(!patt.test($('#txtTruckQuantity').val())) {
	    	alert('กรุณากรอกน้ำหนักเป็นตัวเลข');
	    	return false;
		}

		if(!patt.test($('#consumptionFuel').val())) {
	    	alert('กรุณากรอกอัตราสิ้นเปลืองน้ำมันเป็นตัวเลข');
	    	return false;
		}

		if(!patt.test($('#costTruck').val())) {
	    	alert('กรุณากรอกต้นทุนค่ารถเป็นตัวเลข');
	    	return false;
		}

		if(!patt.test($('#residualValue').val())) {
	    	alert('กรุณากรอกมูลค่าซากรถเป็นตัวเลข');
	    	return false;
		}

		if($('#txtTruckName').val() =='') {
	    	alert('กรณากรอกเลขทะเบียนรถ');
	    	return false;
		}


		alert('บันทึกข้อมูลเรียบร้อย');
	});
});
