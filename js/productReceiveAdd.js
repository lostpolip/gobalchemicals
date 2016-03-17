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
	
var purchaseId = $('#purchaseID').val();
    $( "#searchID" ).autocomplete({
      source: JSON.parse(purchaseId)
    });


	$('#btnCF').click(function() {
		var patt= /[-+]?(\d*[.])?\d+/;

		if(!patt.test($('#txtReceiveAmount').val())) {
	    	alert('กรุณากรอกจำนวนเป็นตัวเลข');
	    	return false;
		}
		alert('บันทึกข้อมูลเรียบร้อย');
	});


	$('#btnSearch').click(function(){
		var purchaseID = ($('#searchID').val());
		$.ajax({
			url: "searchPurchaseID.php", 
			method: "GET",
			data: { 
				purchaseID : purchaseID 
			},
			success: function(result){
				$('#detailPurchaseID').html(result);
		    }
		});
	});


	$(':button[name=receive]').click(function() {
		var productAmount = $(this).data('productamount');
		var totalReceive = $('#totalreceiveAmount' + productID).val();
		var totalAmountProduct = totalReceive+productAmount;
		$('#totalAmountProduct' + productID).text(totalAmountProduct);

	});
});