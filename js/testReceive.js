$( document ).ready(function() {

	$(':button[name=receive]').click(function() {
		var productID = $(this).data('productid');
		var productAmount = $(this).data('productamount');
		var totalreceiveAmount = $('#totalreceiveAmount' + productID).val();
		var totalAmountProduct = totalreceiveAmount+productAmount;

		$('#totalamountProduct' + productID).text(totalAmountProduct);

	});
});