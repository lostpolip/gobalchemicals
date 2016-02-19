$( document ).ready(function() {
	$('#myTabs a').click(function (e) {
	  e.preventDefault()
	  $(this).tab('show')
	});

	$('#btnEmail').click(function() {
			alert('ส่งemailเรียบร้อย');
	});

		$('#btnConfirm').click(function() {
			alert('ยืนยันข้อมูลเรียบร้อย');
	});

});


