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

	

	$(".txtExpenses").on('change',function() {
		
		var count = 0;
		var patt= /[-+]?(\d*[.])?\d+/;
		$("body").find(".txtExpenses").each(function() {
			// alert(count);
			if ($(this).val() == 0) {
				count++;
			}
			if (!patt.test($(this).val())) {
				count++;
			}
			
		});
		if (count==0) {
				$('#btnCalculator').prop("disabled",false);
				
			} else {
				$('#btnCalculator').prop("disabled",true);
				
			}
		
	});


	$(':button[name=calculator]').click(function() {		
		$('#truckInfo').show();
		var consumptionExp = $('#consumptionExp').val();
		var truckCost = $('#truckCost').val();
		var residualValue = $('#residualValue').val();
		var FuelExpensive = $('#FuelExpensive').val();
		var ConsumptionExp = $('#ConsumptionExp').val();
		var LaborExpensive = $('#LaborExpensive').val();
		var AmountExployee = $('#AmountExployee').val();
		var MaintenanceExp = $('#MaintenanceExp').val();
		var AmountDate = $('#AmountDate').val();
		var Distance = $('#totalDistance').val();

		var DepreciationMonth = ((truckCost-residualValue)/ConsumptionExp)/12;
		var DepreciationDay = DepreciationMonth/AmountDate;
		var LaborExpDay = LaborExpensive*AmountExployee ;
		var LaborExpMonth = LaborExpDay*AmountDate;
		var FixedcostsDay = DepreciationDay+LaborExpDay;
		var FixedcostsMonth = FixedcostsDay*AmountDate;
		var FixedcostsAround = FixedcostsDay/1;

		var FuelCost = FuelExpensive/consumptionExp;
		var MaintenanceCost = MaintenanceExp;
		var ExpensesAllKm = FuelCost+MaintenanceCost;

		var ExpensesPerDay = (Distance*ExpensesAllKm)+FixedcostsDay;
		var ExpensesPerAround = ExpensesPerDay;

		$('#DepreciationMonth').text(DepreciationMonth);
		$('#DepreciationDay').text(DepreciationDay);
		$('#LoborExpMonth').text(LaborExpMonth);
		$('#LoborExpDay').text(LaborExpDay);
		$('#FixedcostsDay').text(FixedcostsDay);
		$('#FixedcostsMonth').text(FixedcostsMonth);
		$('#FixedcostsAround').text(FixedcostsAround);

		$('#FuelCost').text(FuelCost);
		$('#MaintenanceCost').text(MaintenanceCost);
		$('#ExpensesAllKm').text(ExpensesAllKm);

		$('#ExpensesPerDay').text(ExpensesPerDay);
		$('#ExpensesPerAround').text(ExpensesPerAround);
		$('#hiddenExpensesPerDay').val(ExpensesPerDay);
		$('#hiddenExpensesPerAround').val(ExpensesPerAround);


		$('#btnCF').prop("disabled",false);

	});


	$(':button[name=btnCF]').click(function() {		
		alert('สร้างเส้นทางเรียบร้อยแล้วค่ะ');
	});


});