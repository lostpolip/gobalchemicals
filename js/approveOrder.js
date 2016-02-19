$( document ).ready(function() {
	$('#myTabs a').click(function (e) {
	  e.preventDefault()
	  $(this).tab('show')
	});

	$('#btnEmail').click(function() {
			alert('ส่งemailเรียบร้อยแล้วค่ะ');
	});

	// $(':button[name=btnConfirm]').click(function() {
	// 	$('#claimDate').addClass('hide');
	// 	$('#claim').addClass('hide');
	// 	$('#btnConfirm').addClass('hide');
	// 	$('#btnCF').addClass('hide');


	// });

});


