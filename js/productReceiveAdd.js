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

	$('#txtLotReceive').change(function(){
		var lot =($('#txtLotReceive').val());
		
		$.ajax({
			url: "searchLot.php", 
			method: "GET",
			data: { 
				lot : lot 
			},
			success: function(result){
				console.log(result);
				if (result==1) {
					alert('ล็อตสินค้าซ้ำ');
					$('#btnCF').prop("disabled",true);
				}else{
					$('#btnCF').prop("disabled",false);
				}
			}
			
		});
	});
	
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