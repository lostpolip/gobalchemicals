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

		if(!patt.test($('#txtProductWeight').val())) {
	    	alert('กรุณากรอกน้ำหนักเป็นตัวเลข');
	    	return false;
		}


		if(!patt.test($('#txtCost').val())) {
	    	alert('กรณากรอกราคาทุนเป็นตัวเลข');
	    	return false;
		}

		if(!patt.test($('#txtPrice').val())) {
	    	alert('กรณากรอกราคาขายเป็นตัวเลข');
	    	return false;
		}		
		alert('บันทึกเรียบร้อย');
	});

	$('#imageProduct').change(function(){
		// var filename = document.getElementById('file-id').value;
		// alert(filename);
		// // $('#imagePath').val(fullPath);

	});
});