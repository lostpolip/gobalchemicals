$( document ).ready(function() {
	$('#district-row').hide();
	$('#subDistrict-row').hide();
	$('#zipcode-row').hide();

	$('#btnCF').click(function() {
		var patt= /[^a-zA-Z0-9]/;

		if(patt.test($('#txtPassword').val())) {
	    	alert('กรณากรอกa-z หรือ A-Z หรือ 0-9เท่านั้น');

	    	return false;
		}
		var customerName = $('#txtName').val().trim();
		var address = $('#txtAddress').val().trim();
		var province = $('#province option:selected').text().trim();
		var district = $('#txtDistrict option:selected').text().trim();
		var supDistrict = $('#txtSubDistrict option:selected').text().trim();
		var zipCode = $('#txtZipcode option:selected').text().trim();
		var locationAddress=address+'+'+province+'+'+district+'+'+supDistrict+'+'+zipCode;
		$.ajax({
			url: "https://maps.googleapis.com/maps/api/geocode/json", 
			method: "GET",
			data: { 
				address : locationAddress,
				key : 'AIzaSyBBQWx9LHwmq7KUVzQr0JNfWmYnqhxUMz8',
			},
			success: function(result){
				var lat = result.results[0].geometry.location.lat;
				var lng = result.results[0].geometry.location.lng;
				$('#txtLatitude').val(lat);
				$('#txtLongitude').val(lng);
			},
			complete: function(){
				$.ajax({
					url: "https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=13.9221481,100.465985&destinations=8.215278%2C99.213333&key=AIzaSyBBQWx9LHwmq7KUVzQr0JNfWmYnqhxUMz8", 
					method: "GET",
					// data: { 
					// 	units : 'imperial',
					// 	origins :'13.93662,100.459377',
					// 	destinations :lat+'%2C'+lng,
					// 	key : 'AIzaSyBBQWx9LHwmq7KUVzQr0JNfWmYnqhxUMz8',
					// },
					success: function(resultDistance){
						console.log(resultDistance);
						// $( "#registerAddForm" ).submit();
					}
				});
			}
		});
	
		alert('สมัครสมาชิกเรียบร้อยแล้วค่ะ');
	});
	
	$('#province').change(function(){
		$('#txtSubDistrict').empty();
		$('#txtZipcode').empty();
		var provinceID = $('#province').val();
		$.ajax({
			url: "province.php", 
			method: "GET",
			data: { 
				provinceID : provinceID 
			},
			success: function(result){
		    	$('#txtDistrict').empty();
		    	var aumphur = jQuery.parseJSON(result);
		    	$('#txtDistrict').append('<option value="default">---กรุณาเลือก---</option>');
		    	for (var x in aumphur['name']) {
					$('#txtDistrict').append('<option value="'+$.trim(aumphur['ID'][x])+'">'+aumphur['name'][x]+'</option>');
				}
				$('#district-row').show(); 
		    }
		});
	});


	$('#txtDistrict').change(function(){
		 
		var districtID = $('#txtDistrict').val();
		$('#txtZipcode').empty();

		$.ajax({
			url: "district.php", 
			method: "GET",
			data: { 
				districtID : districtID 
			},
			success: function(result){
				// console.log(jQuery.parseJSON(result));
		    	$('#txtSubDistrict').empty();
		    	var subDistrict = jQuery.parseJSON(result);
		    	$('#txtSubDistrict').append('<option value="default">---กรุณาเลือก---</option>');
				    // console.log(subDistrict);
		    	for (var x in subDistrict['name']) {
					$('#txtSubDistrict').append('<option value="'+$.trim(subDistrict['ID'][x])+'">'+subDistrict['name'][x]+'</option>');
				}
			$('#subDistrict-row').show();
		   }
		});
	});


	$('#txtSubDistrict').change(function(){

		var subDistrictID = $('#txtSubDistrict').val();
		$.ajax({
			url: "subDistrict.php",
			meyhod: "GET",
			data: {
				subDistrictID : subDistrictID
			},
			success: function(result){
			    $('#txtZipcode').empty();
		    	var zipCode = jQuery.parseJSON(result);
		    	$('#txtZipcode').append('<option value="default">---กรุณาเลือก---</option>');
		    	for (var x in zipCode['name']) {
				$('#txtZipcode').append('<option value="'+$.trim(zipCode['ID'][x])+'">'+zipCode['name'][x]+'</option>');
				}
			$('#zipcode-row').show();	
			}
		});
	});




});



