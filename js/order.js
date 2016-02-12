$( document ).ready(function() {
	$(':button[name=order]').click(function() {
		var productID = $(this).data('productid');
		var productName = $(this).data('productname');
		var productPrice = $(this).data('productprice');
		var productWeight = $(this).data('productweight');
		var totalProduct = $('#totalProduct' + productID).val();
		var totalUnit = (totalProduct*1000)/productWeight;
		var totalPrice = productPrice*totalUnit;
		var orderIDVal =  $('#order-id').val();

		$('#totalProductOrder' + productID).text(totalProduct);
		$('#totalPriceOrder' + productID).text(totalPrice);
		$('#totalUnitOrder' + productID).text(totalUnit);

		$('#hiddenProductOrder' + productID).val(totalProduct);
		$('#hiddentotalUnitOrder' + productID).val(totalUnit);
		$('#hiddentotalPriceOrder' + productID).val(totalPrice);

		if (totalProduct > 0) {
			$('#row' + productID).removeClass('hide');

			$('#hiddenproductID' + productID).removeAttr("disabled");
			$('#hiddenProductOrder' + productID).removeAttr("disabled");
			$('#hiddentotalUnitOrder' + productID).removeAttr("disabled");
			$('#hiddentotalPriceOrder' + productID).removeAttr("disabled");		
			$('#hiddenproductCost' + productID).removeAttr("disabled");
			// $('#hiddenproductName' + productID).removeAttr("disabled");

			if ($('#order-id').val() == '') {
				$('#order-id').val(productID);
			} else {
				$('#order-id').val(orderIDVal + ' ' + productID);
			}
		} else {
			$('#row' + productID).addClass('hide');

			$('#hiddenproductID' + productID).attr("disabled", 'disabled');
			$('#hiddenProductOrder' + productID).attr("disabled", 'disabled');
			$('#hiddentotalUnitOrder' + productID).attr("disabled", 'disabled');
			$('#hiddentotalPriceOrder' + productID).attr("disabled", 'disabled');		
			$('#hiddenproductCost' + productID).attr("disabled", 'disabled');
			// $('#hiddenproductName' + productID).attr("disabled", 'disabled');

			var reqEx = new RegExp(productID, "g");
			$('#order-id').val(orderIDVal.replace(reqEx,''));
		}

		// alert(totalPrice);
	});
});