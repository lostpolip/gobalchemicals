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

	$('#row-supplierName').hide();
	$('#row_productType').hide();
	$('#row-brandName').hide();


	$('#btnCF').click(function() {
		var patt= /[-+]?(\d*[.])?\d+/;

		if(!patt.test($('#txtReceiveAmount').val())) {
	    	alert('กรุณากรอกน้ำหนักเป็นตัวเลข');
	    	return false;
		}
		alert('แก้ไขข้อมูลเรียบร้อย');
	});

	$('#ddProduct').change(function(){

		var productID = $('#ddProduct').val();
		$.ajax({
			url: "productPurchaseProducttype.php", 
			method: "GET",
			data: { 
				productID : productID 
			},
			success: function(result){
		    	var detailProduct = jQuery.parseJSON(result);

		    	for (var x in detailProduct['nameProductType']) {
					$('#ddProductType').append('<input type="text" value=" '+detailProduct['nameProductType'][x]+' ">');
					$('#ddBrandName').append('<input type="text" value=" '+detailProduct['nameBrand'][x]+' ">');
					$('#txtsupplierName').append('<input type="text" value=" '+detailProduct['nameSupplier'][x]+' ">');

				}
				$('#row_productType').show();
				$('#row-brandName').show();
				$('#row-supplierName').show();
		    }
		});
	});

});