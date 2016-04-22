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


function formatDate(date) {
	var arrayDate = date.split('-');

	return arrayDate[2]+'-'+arrayDate[1]+'-'+arrayDate[0];
}

$( document ).ready(function() {
	claimAlert();
	orderAlert();
	setInterval(function(){ 
		claimAlert();
		orderAlert();
	}, 5000);
		$('#order').hide();


	$("input[name='lastDate']").change(function(){
		$('#order').show();
		$('#bodyTable').empty();
		
		$.ajax({
			url: "tableOrder.php", 
			method: "GET",
			data: { 
				datetransport : $('#lastDate').val()
			},
			success: function(result){

			var orderDetail = jQuery.parseJSON(result);
			if (orderDetail != 'empty') {
				for (var x in orderDetail['OrderID']) {
					$('#bodyTable').append("<tr>  <td>"+formatDate(orderDetail['OrderSendDate'][x])+"</td> <td>"+orderDetail['OrderID'][x]+"</td>  <td>"+orderDetail['GeoName'][x]+"</td> <td>"+orderDetail['CustomerName'][x]+"</td> <td>"+orderDetail['UnitProduct'][x]+"</td> </tr> ");	      
				}
			} else {
				$('#bodyTable').empty();
				$('#bodyTable').append("<tr><td colspan='5'>ไม่พบรายการที่สั่งซื้อ</td></tr> ");	      
			}
			
			}
		});

	});
});