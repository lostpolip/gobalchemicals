$( document ).ready(function() {
	$(':button[name=order]').click(function() {
		var productID = $(this).data('productid');
		var productName = $(this).data('productname');
		var productPrice = $('#productPrice' + productID).text();
		var totalProduct = $('#totalProduct' + productID).val();
		$('#totalProductOrder' + productID).text(totalProduct);

		if (totalProduct > 0) {
			$('#row' + productID).removeClass('hide');
		} else {
			$('#row' + productID).addClass('hide');
		}
	});
});