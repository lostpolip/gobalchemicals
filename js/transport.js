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


function initMap() {
  var directionsService = new google.maps.DirectionsService;
  var directionsDisplay = new google.maps.DirectionsRenderer;
  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 18,
    center: {lat: 13.922080715335339, lng: 100.46815484762192}
  });
  directionsDisplay.setMap(map);
calculateAndDisplayRoute(directionsService, directionsDisplay);

}

function calculateAndDisplayRoute(directionsService, directionsDisplay) {
  var waypts = [];
  var checkboxArray = document.getElementById('waypoints');
  for (var i = 0; i < checkboxArray.length; i++) {
    if (checkboxArray.options[i].selected) {
      waypts.push({
        location: checkboxArray[i].value,
        stopover: true
      });
    }
  }

  directionsService.route({
   	origin: document.getElementById('start').value,
    destination: document.getElementById('end').value,
    waypoints: waypts,
    optimizeWaypoints: true,
    travelMode: google.maps.TravelMode.DRIVING,
    avoidHighways: true,
  }, function(response, status) {
    if (status === google.maps.DirectionsStatus.OK) {
      directionsDisplay.setDirections(response);
      var route = response.routes[0];
      var summaryPanel = document.getElementById('directions-panel');
      summaryPanel.innerHTML = '';
      // For each route, display summary information.
      for (var i = 0; i < route.legs.length; i++) {
        var routeSegment = i + 1;
        summaryPanel.innerHTML += '<b>Route Segment: ' + routeSegment +
            '</b><br>';
        summaryPanel.innerHTML += route.legs[i].start_address + ' to ';
        summaryPanel.innerHTML += route.legs[i].end_address + '<br>';
        summaryPanel.innerHTML += route.legs[i].distance.text + '<br><br>';
      }
    } else {
      window.alert('Directions request failed due to ' + status);
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



	$("input[name='rdoDate']").click(function(){
		$('#truckInfo').show();
		$('#employeeInfo').hide();
		$('#truckOther').html('');
		$('#employeeInfo').show();


		if (this.id == 'rdoDate1') {
			var timeaction = $("#rdoDate1").val();
		} else if (this.id == 'rdoDate2') {
			var timeaction = $("#rdoDate2").val();
		} else {
			var timeaction = $("#rdoDate3").val();
		}

		$.ajax({
			url: "searchTruck.php", 
			method: "GET",
			data: { 
				timeaction : timeaction,
				datetransport : $('#txtDateTransport').val()
			},
			success: function(result){
				var TruckOther = jQuery.parseJSON(result);

		    	for (var x in TruckOther['name']) {
					$('#truckOther').append('<input type="radio" name="listTruckName" data-weight-capacity="'+ $.trim(TruckOther["weightcapacity"][x]) +'" data-available="'+ TruckOther["available"][x] +'" id="'+ $.trim(TruckOther["ID"][x]) +'" value="'+ $.trim(TruckOther["ID"][x]) +'"'+ TruckOther['available'][x]+' > '+'<label for="'+ $.trim(TruckOther["ID"][x]) +'">'+TruckOther['trucktype'][x]+'('+ TruckOther['weightcapacity'][x]	+'ตัน) | เลขทะเบียน: '+TruckOther['name'][x] +'</label><br>');
				}

				$("input[name='listTruckName']").change(function() {
					var weightCar = $("input[name='listTruckName']:checked").data('weight-capacity');

					$.ajax({
						url: "searchOrder.php", 
						method: "GET",
						data: { 
							weightCar : weightCar,
						},
						success: function(orderInQueue){
							var orderInQueue = jQuery.parseJSON(orderInQueue);

							for (geoId in orderInQueue) {

								for (index in orderInQueue[geoId]['OrderID']) {
									var lat = orderInQueue[geoId]['latOrder'][index];
									var lng = orderInQueue[geoId]['lonOrder'][index];
									console.log('geocod='+geoId+'->'+lat+','+lng);
								}
								// console.log('\n');
								// console.log(orderInQueue[geoId]['latOrder']);
								// for (index in orderInQueue[geoId]) {
								// 	console.log(index);
								// }
							}
						}
					});

					
				});
			}
		});

		$.ajax({
			url: "searchEmployee.php", 
			method: "GET",
			data: { 
				timeaction : timeaction,
				datetransport : $('#txtDateTransport').val()
			},
			success: function(result){
				$('#employeeOther').empty();
				var EmployeeOther = jQuery.parseJSON(result);

		    	for (var x in EmployeeOther['name']) {
					$('#employeeOther').append('<input type="radio" name="listEmployeeName" data-available="'+ EmployeeOther["available"][x]+'" id="'+ $.trim(EmployeeOther["ID"][x]) +'" value="'+ $.trim(EmployeeOther["ID"][x]) +'"'+ EmployeeOther["available"][x]+' > '+'<label for="'+ $.trim(EmployeeOther["ID"][x]) +'">'+EmployeeOther['name'][x] +'</label><br>');
				}
			}
		});
	});

	$('#rdoDate1').trigger('click');

	$('#txtDateTransport').change(function(){
		$('#rdoDate1').trigger('click');
	});

	$('#btnCF').click(function(){

	});

	initMap();
});