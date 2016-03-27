$( document ).ready(function() {
	
	$('#btncalculator').click(function() {
		var Rete = $('#rate').val();
		var Extended = $('#extended').val();
		var Latitude =$('#lat_value').val();
        var Longitude =$('#lon_value').val();

		$.ajax({
			url: "https://maps.googleapis.com/maps/api/distancematrix/json", 
			method: "GET",
			crossDomain: true,
			data: { 
				units : 'imperial',
				origins :'13.92209633583074, 100.46814747154713',
				destinations :Latitude+','+Longitude,
				key : 'AIzaSyBBQWx9LHwmq7KUVzQr0JNfWmYnqhxUMz8',
			},
			success: function(resultDistance){
				var distance = resultDistance.rows[0].elements[0].distance.text;
				var distanceSubString = distance.substring(0,4);
				var distancePerKm = distanceSubString*1.61;
				$('#txtDistance').val(distancePerKm);

				var calculatorTransport = Rete*distancePerKm;						
				var totalTransport = parseFloat(calculatorTransport.toFixed(2));									
				$('#totalTransaction').val(totalTransport);

				var ExtendedToint = parseFloat(Extended);
				var calculatorExtended =ExtendedToint+totalTransport ;
				$('#totalExtendPrice').val(calculatorExtended);


			}
		});
	});

	$('#btnOK').click(function() {
		if (!confirm('สั่งซื้อเรียบร้อยแล้วค่ะ')) {
			return false;	
		}
	});
});