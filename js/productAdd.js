$( document ).ready(function() {
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

	});
});