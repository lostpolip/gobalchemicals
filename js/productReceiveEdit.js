$( document ).ready(function() {

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