var map; // กำหนดตัวแปร map ไว้ด้านนอกฟังก์ชัน เพื่อให้สามารถเรียกใช้งาน จากส่วนอื่นได้  
var GGM; // กำหนดตัวแปร GGM ไว้เก็บ google.maps Object จะได้เรียกใช้งานได้ง่ายขึ้น  
function initialize() { // ฟังก์ชันแสดงแผนที่  

    GGM=new Object(google.maps); // เก็บตัวแปร google.maps Object ไว้ในตัวแปร GGM  
    // กำหนดจุดเริ่มต้นของแผนที่  
    var my_Latlng  = new GGM.LatLng(lat,lng);  
    var my_mapTypeId=GGM.MapTypeId.ROADMAP; // กำหนดรูปแบบแผนที่ที่แสดง  
    // กำหนด DOM object ที่จะเอาแผนที่ไปแสดง ที่นี้คือ div id=map_canvas  
    var my_DivObj=$("#map_canvas")[0];   
    // กำหนด Option ของแผนที่  
    var myOptions = {  
        zoom: 13, // กำหนดขนาดการ zoom  
        center: my_Latlng , // กำหนดจุดกึ่งกลาง  
        mapTypeId:my_mapTypeId // กำหนดรูปแบบแผนที่  
    };  
    map = new GGM.Map(my_DivObj,myOptions);// สร้างแผนที่และเก็บตัวแปรไว้ในชื่อ map  
      
    var my_Marker = new GGM.Marker({ // สร้างตัว marker  
        position: my_Latlng,  // กำหนดไว้ที่เดียวกับจุดกึ่งกลาง  
        map: map, // กำหนดว่า marker นี้ใช้กับแผนที่ชื่อ instance ว่า map  
        draggable:true, // กำหนดให้สามารถลากตัว marker นี้ได้  
        title:"คลิกลากเพื่อหาตำแหน่งจุดที่ต้องการ!" // แสดง title เมื่อเอาเมาส์มาอยู่เหนือ  
    });  
      
    // กำหนด event ให้กับตัว marker เมื่อสิ้นสุดการลากตัว marker ให้ทำงานอะไร  
    GGM.event.addListener(my_Marker, 'dragend', function() {  
        var my_Point = my_Marker.getPosition();  // หาตำแหน่งของตัว marker เมื่อกดลากแล้วปล่อย  
        map.panTo(my_Point);  // ให้แผนที่แสดงไปที่ตัว marker         
        $("#lat_value").val(my_Point.lat());  // เอาค่า latitude ตัว marker แสดงใน textbox id=lat_value  
        $("#lon_value").val(my_Point.lng()); // เอาค่า longitude ตัว marker แสดงใน textbox id=lon_value   
        $("#zoom_value").val(map.getZoom()); // เอาขนาด zoom ของแผนที่แสดงใน textbox id=zoom_value  
    });       
  
    // กำหนด event ให้กับตัวแผนที่ เมื่อมีการเปลี่ยนแปลงการ zoom  
    GGM.event.addListener(map, 'zoom_changed', function() {  
        $("#zoom_value").val(map.getZoom()); // เอาขนาด zoom ของแผนที่แสดงใน textbox id=zoom_value    
    });  
  
}  

$( document ).ready(function() {
	$('#district-row').hide();
	$('#subDistrict-row').hide();
	$('#zipcode-row').hide();

	$('#btnCF').click(function() {
		var province = $('#province option:selected').text().trim();
		var district = $('#txtDistrict option:selected').text().trim();
		var supDistrict = $('#txtSubDistrict option:selected').text().trim();
		var zipCode = $('#txtZipcode option:selected').text().trim();
		var locationAddress=province+'+'+district+'+'+supDistrict+'+'+zipCode;
		$.ajax({
			url: "https://maps.googleapis.com/maps/api/geocode/json", 
			method: "GET",
			crossDomain: true,
			data: { 
				address : locationAddress,
				zoom : 13,
				key : 'AIzaSyBBQWx9LHwmq7KUVzQr0JNfWmYnqhxUMz8',
			},
			success: function(result){

				var lat = result.results[0].geometry.location.lat;
				var lng = result.results[0].geometry.location.lng;
				$('#txtLatitude').val(lat);
				$('#txtLongitude').val(lng);
				window.lat = lat;
				window.lng = lng;

				$('#hide').show();
				// โหลด สคริป google map api เมื่อเว็บโหลดเรียบร้อยแล้ว  
                // ค่าตัวแปร ที่ส่งไปในไฟล์ google map api  
                // v=3.2&sensor=false&language=th&callback=initialize  
                //  v เวอร์ชัน่ 3.2  
                //  sensor กำหนดให้สามารถแสดงตำแหน่งทำเปิดแผนที่อยู่ได้ เหมาะสำหรับมือถือ ปกติใช้ false  
                //  language ภาษา th ,en เป็นต้น  
                //  callback ให้เรียกใช้ฟังก์ชันแสดง แผนที่ initialize  
                $("<script/>", {  
                  "type": "text/javascript",  
                  src: "http://maps.google.com/maps/api/js?v=3.2&sensor=false&language=th&callback=initialize"  
                }).appendTo("body");   
			}
		});
	});

	// $('#btnSubmit').click(function() {
	// 	var Latitude =$('#lat_value').val();
 //        var Longitude =$('#lon_value').val();
  
	// 	$.ajax({
	// 		url: "https://maps.googleapis.com/maps/api/distancematrix/json", 
	// 		method: "GET",
	// 		crossDomain: true,
	// 		data: { 
	// 			units : 'imperial',
	// 			origins :'13.92209633583074, 100.46814747154713',
	// 			destinations :Latitude+','+Longitude,
	// 			key : 'AIzaSyBBQWx9LHwmq7KUVzQr0JNfWmYnqhxUMz8',
	// 		},
	// 		success: function(resultDistance){
	// 			var distance = resultDistance.rows[0].elements[0].distance.text;
	// 			$('#txtDistance').val(distance);
	// 			$( "#registerAddForm" ).submit();				
				
	// 		}
	// 	});
		
	// 	alert('สมัครสมาชิกเรียบร้อยแล้วค่ะ');
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








	$('#btnOK').click(function() {
		if (!confirm('สั่งซื้อเรียบร้อยแล้วค่ะ')) {
			return false;	
		}
	});
	
});