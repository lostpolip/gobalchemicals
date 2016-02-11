$( document ).ready(function() {

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
		alert('แก้ไขข้อมูลเรียบร้อย');
	});
});