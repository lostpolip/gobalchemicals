$( document ).ready(function() {
var orderId = $('#orderID').val();
    $( "#searchID" ).autocomplete({
      source: JSON.parse(orderId)

    });
   
	$('#btnCF').click(function() {
		var patt= /[-+]?(\d*[.])?\d+/;

		if(!patt.test($('#txtClaimAmount').val())) {
	    	alert('กรุณากรอกจำนวนเป็นตัวเลข');
	    	return false;
		}
	});


	$('#btnSearch').click(function(){
		var orderID = ($('#searchID').val());
		$.ajax({
			url: "searchOrderID.php", 
			method: "GET",
			data: { 
				orderID : orderID 
			},
			success: function(result){
				$('#detailOrderID').html(result);
		    }
		});
	});

	$(':button[name=btnCF]').click(function() {		
		alert('สร้างเส้นทางเรียบร้อยแล้วค่ะ');
	});
	
});
