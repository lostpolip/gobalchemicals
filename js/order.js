$( document ).ready(function() {
	$(':button[name=order]').click(function() {
		var productID = $(this).data('productid');
		var productName = $(this).data('productname');
		var productPrice = $('#productPrice' + productID).text();
		var totalProduct = $('#totalProduct' + productID).val();
	});
});