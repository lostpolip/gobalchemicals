$( document ).ready(function() {

	$('#btnCF').click(function() {
		var patt= /[-+]?(\d*[.])?\d+/;

		if(!patt.test($('#txtReceiveAmount').val())) {
	    	alert('กรุณากรอกน้ำหนักเป็นตัวเลข');
	    	return false;
		}
		alert('บันทึกข้อมูลเรียบร้อย');
	});
