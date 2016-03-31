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

	$( "#submit" ).trigger( "click" );
	$('#truckInfo').hide();

	$(':button[name=calculator]').click(function() {
		var count = 0;
		var countNumber = 0;
		var patt= /[-+]?(\d*[.])?\d+/;
		$("body").find(".txtExpenses").each(function() {
			// alert(count);
			if ($(this).val() == 0) {
				count++;
			}
			// alert($(this).id);
			if (!patt.test($(this).val())) {
				countNumber++;
			}
			
		});
		if (count > 0 || countNumber > 0) {
			alert('กรุณากรอกข้อมูลให้ครบ');
			return false;
		}		
		$('#truckInfo').show();

		var truckIdAll = $('#truck-id').val().split(',');
		for (y in truckIdAll) {
			var consumptionExp = $('#consumptionExp'+truckIdAll[y]).val();
			var truckCost = $('#truckCost'+truckIdAll[y]).val();
			var residualValue = $('#residualValue'+truckIdAll[y]).val();
			var FuelExpensive = $('#FuelExpensive'+truckIdAll[y]).val();
			var ConsumptionExp = $('#ConsumptionExp'+truckIdAll[y]).val();
			var LaborExpensive = $('#LaborExpensive'+truckIdAll[y]).val();
			var AmountExployee = $('#AmountExployee'+truckIdAll[y]).val();
			var MaintenanceExp = $('#MaintenanceExp'+truckIdAll[y]).val();
			var Distance = $('#labelDistance').text();

			var DepreciationMonth = ((truckCost-residualValue)/ConsumptionExp)/12;
			var DepreciationDay = DepreciationMonth/1;
			var LaborExpDay = LaborExpensive*AmountExployee ;
			var LaborExpMonth = LaborExpDay*1;
			var FixedcostsDay = DepreciationDay+LaborExpDay;
			var FixedcostsMonth = FixedcostsDay*1;
			var FixedcostsAround = FixedcostsDay/1;

			var FuelCost = FuelExpensive/consumptionExp;
			var MaintenanceCost = MaintenanceExp;
			var ExpensesAllKm = FuelCost+MaintenanceCost;

			var ExpensesPerDay = (Distance*ExpensesAllKm)+FixedcostsDay;
			var ExpensesPerAround = ExpensesPerDay;
			
			$('#hiddenExpensesPerAround'+truckIdAll[y]).val(formatNumber(ExpensesPerAround));
			$('#ExpensesPerAround'+truckIdAll[y]).text(formatNumber(ExpensesPerAround));
		}

		$('#btnCF').prop("disabled",false);

	});


	$(':button[name=btnCF]').click(function() {		
		alert('สร้างเส้นทางเรียบร้อยแล้วค่ะ');
	});


});

var formatNumber = function(temp) {
	var temp = temp.toFixed(2);
	return parseFloat(temp);
}



















