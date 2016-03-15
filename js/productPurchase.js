$( document ).ready(function() {	
	$('#row-supplierEmail').hide();
	$('#row_productType').hide();
	$('#row-brandName').hide();				
	$('#row-supplier').hide();

	$('#btnCF').click(function() {

		var patt= /[-+]?(\d*[.])?\d+/;

		if(!patt.test($('#txtProductAmount').val())) {
	    	alert('กรุณากรอกจำนวนเป็นตัวเลข');
	    	return false;
		}
			alert('บันทึกเรียบร้อย');
		});

	$('#btnEmail').click(function() {
			alert('ส่งemailเรียบร้อยแล้วค่ะ');
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
				$('#ddProductType').empty();
				$('#ddBrandName').empty();
				$('#ddSupplier').empty();
				$('#txtSupplierEmail').empty();
				
		    	var detailProduct = jQuery.parseJSON(result);

		    	for (var x in detailProduct['nameProductType']) {
					$('#ddProductType').append('<input type="text" value=" '+detailProduct['nameProductType'][x]+' ">');
					$('#ddBrandName').append('<input type="text" value=" '+detailProduct['nameBrand'][x]+' ">');
					$('#supplierId').append('<input type="hidden" id="IdSupplier" value=" '+detailProduct['nameSupplierID'][x]+' ">');
					$('#ddSupplier').append('<input type="text" value=" '+detailProduct['nameSupplier'][x]+' ">');
					$('#txtSupplierEmail').append('<input type="text" value=" '+detailProduct['email'][x]+' ">');					

				}
				$('#row_productType').show();
				$('#row-brandName').show();
				$('#row-supplier').show();
				$('#row-supplierEmail').show();
				
		    }
		});
	});
});