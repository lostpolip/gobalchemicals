$( document ).ready(function() {	
	$('#row-supplierEmail').hide();
	$('#row_productType').hide();
	$('#row-brandName').hide();


	$('#btnCF').click(function() {
			alert('บันทึกเรียบร้อย');
		});

	$('#ddSupplier').change(function(){

		var supplierID = $('#ddSupplier').val();
		$.ajax({
			url: "productPurchaseSupplier.php", 
			method: "GET",
			data: { 
				supplierID : supplierID 
			},
			success: function(result){
				$('#txtSupplierEmail').empty();
		    	var detailSupplier = jQuery.parseJSON(result);

		    	for (var x in detailSupplier['email']) {
					$('#txtSupplierEmail').append('<input type="text" value=" '+detailSupplier['email'][x]+' ">');
				}

				$('#row-supplierEmail').show();
		    }
		});
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
		    	var detailProduct = jQuery.parseJSON(result);

		    	for (var x in detailProduct['nameProductType']) {
					$('#ddProductType').append('<input type="text" value=" '+detailProduct['nameProductType'][x]+' ">');
					$('#ddBrandName').append('<input type="text" value=" '+detailProduct['nameBrand'][x]+' ">');

				}
				$('#row_productType').show();
				$('#row-brandName').show();
		    }
		});
	});

});