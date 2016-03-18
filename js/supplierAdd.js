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

		if($('#txtSupplierName').val() =='') {
	    	alert('กรณากรอกชื่ผู้จัดจำหน่าย');
	    	return false;
		}
		if($('#txtSupplierAddress').val() =='') {
	    	alert('กรณากรอกที่อยู่');
	    	return false;
		}
		if($('#txtSupplierDistrict').val() =='') {
	    	alert('กรณากรอกตำบล');
	    	return false;
		}
		if($('#txtSupplierAumphur').val() =='') {
	    	alert('กรณากรอกอำเภอ');
	    	return false;
		}
		if($('#txtSupplierProvince').val() =='') {
	    	alert('กรณากรอกจังหวัด');
	    	return false;
		}
		if($('#txtSupplierZipcode').val() =='') {
	    	alert('กรณากรอกรหัสไปรษณีย์');
	    	return false;
		}

			alert('บันทึกเรียบร้อย');
		});

});