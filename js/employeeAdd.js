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
	
	$('#district-row').hide();
	$('#subDistrict-row').hide();
	$('#zipcode-row').hide();


	$('#btnCF').click(function() {
		var patt= /[^a-zA-Z0-9]/;

		if(patt.test($('#txtPassword').val())) {
	    	alert('กรณากรอกa-z หรือ A-Z หรือ 0-9เท่านั้น');
	    	return false;
		}

		if($('#txtEmployeeName').val() =='') {
	    	alert('กรณากรอกชื่พนักงาน');
	    	return false;
		}
		if($('#txtEmployeeAddress').val() =='') {
	    	alert('กรณากรอกที่อยู่');
	    	return false;
		}

			alert('บันทึกเรียบร้อย');
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