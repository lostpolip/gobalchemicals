$( document ).ready(function() {	
	$( "#submit" ).trigger( "click" );

	$(':button[name=calculator]').click(function() {		
		
		var consumptionExp = $('#consumptionExp').val();
		var truckCost = $('#truckCost').val();
		var residualValue = $('#residualValue').val();
		var FuelExpensive = $('#FuelExpensive').val();
		var ConsumptionExp = $('#ConsumptionExp').val();
		var LaborExpensive = $('#LaborExpensive').val();
		var AmountExployee = $('#AmountExployee').val();
		var MaintenanceExp = $('#MaintenanceExp').val();
		var AmountDate = $('#AmountDate').val();
		var Distance = $(this).data('distance');

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

		var ExpensesPerDay = (FixedcostsDay+ExpensesAllKm)*Distance;
		var ExpensesPerAround = ExpensesPerDay/1;

				
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

	});

});