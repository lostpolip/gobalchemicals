$( document ).ready(function() {
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
		// var totalPrice = productPrice*totalUnit;
		// var orderIDVal =  $('#order-id').val();

		$('#totalAmountProduct' + productID).text(totalAmountProduct);
		// $('#totalPriceOrder' + productID).text(totalPrice);
		// $('#totalUnitOrder' + productID).text(totalUnit);
	});
});