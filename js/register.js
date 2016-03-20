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
				var lat = $('#lat_value').val();
				var lng = $('#lon_value').val();
	
				$.ajax({
					url: "https://maps.googleapis.com/maps/api/distancematrix/json", 
					method: "GET",
					crossDomain: true,
					data: { 
						units : 'imperial',
						origins :'13.92209633583074, 100.46814747154713',
						destinations :lat+','+lng,
						key : 'AIzaSyBBQWx9LHwmq7KUVzQr0JNfWmYnqhxUMz8',
					},
					success: function(resultDistance){
						var distance = resultDistance.rows[0].elements[0].distance.text;
						$('#txtDistance').val(distance);						
						$( "#registerAddForm" ).submit();
					}
				});

		if($('#txtUsername').val() =='') {
	    	alert('กรณากรอกชื่อผู้ใช้งาน');
	    	return false;
		}
		if($('#txtName').val() =='') {
	    	alert('กรณากรอกชื่อบริษัท');
	    	return false;
		}
		if($('#txtAddress').val() =='') {
	    	alert('กรณากรอกที่อยู่');
	    	return false;
		}
	
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



	$('#txtUsername').change(function(){
		var name =$('#txtUsername').val();
		$.ajax({
			url: "searchUsername.php", 
			method: "GET",
			data: { 
				name : name 
			},
			success: function(result){
				console.log(result);
				if (result==1) {
					alert('ชื่อผู้ใช้งานนี้ซ้ำ');
					$('#btnCF').prop("disabled",true);
				}else{
					$('#btnCF').prop("disabled",false);
				}
			}
			
		});
	});
});



