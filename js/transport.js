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

	$('#order').hide();

	$("input[name='lastDate']").change(function(){
		$('#order').show();
		$('#table2').empty();
		
		$.ajax({
			url: "tableOrder.php", 
			method: "GET",
			data: { 
				datetransport : $('#lastDate').val()
			},
			success: function(result){
			// $('#table2').empty();
			// <th>วันที่กำหนดส่งสินค้า</th> <th>รหัสสั่งซื้อ</th> <th>ชื่อลูกค้า</th> <th>ภูมิภาค</th> <th>น้ำหนักสินค้า(ตัน)</th> </tr>
			var orderDetail = jQuery.parseJSON(result);
			for (var x in orderDetail['OrderID']) {
				$('#table2').append("<tr>  <tr> <td>"+orderDetail['OrderID'][x]+"</td> <td>"+orderDetail['OrderSendDate'][x]+"</td> <td>"+orderDetail['GeoName'][x]+"</td> <td>"+orderDetail['CustomerName'][x]+"</td> <td>"+orderDetail['UnitProduct'][x]+"</td> </tr> ");	   
				}
			}
		});

	});
});