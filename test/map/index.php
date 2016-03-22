<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Google Map API 3 - 01</title>
<style type="text/css">
html { height: 100% }
body { 
	height:100%;
	margin:0;padding:0;
	margin-right: 2px;
}
/* css กำหนดความกว้าง ความสูงของแผนที่ */
#map_canvas { 
	width:100%;
	height:50%;
	margin-top: 5px;
}
select,input,option {
	width: 100%;
	padding: 5px;
	font-size: 18px;
	border-radius: 5px;
	border: none;

}
</style>


</head>

<body onload="Add()">


	<select name="Proviance" id="Proviance" style="margin-top: 5px;"></select>

	<input type="hidden" name="ProID" id="ProID" />

  	<select name="District" id="District" style="margin-top: 5px;"></select>

  	<input type="hidden" name="DisID" id="DisID"  />

  	<select name="Subdistrict" id="Subdistrict" style="margin-top: 5px;"></select>

  <input type="hidden" name="SubID" id="SubID" />


  <div id="map_canvas"></div>
 <div id="showDD" style="padding-top:5px; width:100%; min-width:300px;">  
<!--textbox กรอกชื่อสถานที่ และปุ่มสำหรับการค้นหา เอาไว้นอกแท็ก <form>-->
  <div style="display:none">
  <input name="namePlace" type="text" id="namePlace" size="40" style="margin-button: 5px;" />
  <input type="button" name="SearchPlace" id="SearchPlace" value="Search" />
  </div>

<!--  <form> เก็บข้อมูลสำหรับนำไปบันทึกลงฐานข้อมูล หรือนำไปใช้อื่นๆ-->

  <form id="form_get_detailMap" name="form_get_detailMap" method="post" action="">    
  
  	<P>
    <input name="lat_value" type="hidden" id="lat_value" value="0" size="17" />  
    </p>
    <P>
    <input name="lon_value" type="hidden" id="lon_value" value="0" size="17" />  
    </p>
   
    <input name="zoom_value" type="hidden" id="zoom_value" value="0" size="10" />  
   
  </form>  

</div> 
  

<script type="text/javascript" src="map/ThailandFilter.js"></script>


<script type="text/javascript">

var geocoder; // กำหนดตัวแปรสำหรับ เก็บ Geocoder Object ใช้แปลงชื่อสถานที่เป็นพิกัด
var map; // กำหนดตัวแปร map ไว้ด้านนอกฟังก์ชัน เพื่อให้สามารถเรียกใช้งาน จากส่วนอื่นได้
var my_Marker; // กำหนดตัวแปรสำหรับเก็บตัว marker
var GGM; // กำหนดตัวแปร GGM ไว้เก็บ google.maps Object จะได้เรียกใช้งานได้ง่ายขึ้น
function initialize() { // ฟังก์ชันแสดงแผนที่
 if (navigator.geolocation){

 	 navigator.geolocation.getCurrentPosition(function(position){
        	var curentLati = position.coords.latitude;
        	var curentLong = position.coords.longitude;
            $("#lat_value").val(curentLati);  // เอาค่า latitude ตัว marker แสดงใน textbox id=lat_value
            $("#lon_value").val(curentLong); // เอาค่า longitude ตัว marker แสดงใน textbox id=lon_value 
            // สรัาง LatLng ตำแหน่งปัจจุบัน watchPosition
               
 
 
	GGM = new Object(google.maps); // เก็บตัวแปร google.maps Object ไว้ในตัวแปร GGM
	geocoder = new GGM.Geocoder(); // เก็บตัวแปร google.maps.Geocoder Object
	// กำหนดจุดเริ่มต้นของแผนที่

	var my_Latlng  = new GGM.LatLng(curentLati,curentLong);
	var my_mapTypeId=GGM.MapTypeId.ROADMAP; // กำหนดรูปแบบแผนที่ที่แสดง
	// กำหนด DOM object ที่จะเอาแผนที่ไปแสดง ที่นี้คือ div id=map_canvas
	var my_DivObj=$("#map_canvas")[0];
	// กำหนด Option ของแผนที่
	var myOptions = {
		zoom: 13, // กำหนดขนาดการ zoom
		center: my_Latlng , // กำหนดจุดกึ่งกลาง จากตัวแปร my_Latlng
		mapTypeId:my_mapTypeId // กำหนดรูปแบบแผนที่ จากตัวแปร my_mapTypeId
	};
	map = new GGM.Map(my_DivObj,myOptions); // สร้างแผนที่และเก็บตัวแปรไว้ในชื่อ map


	
	my_Marker = new GGM.Marker({ // สร้างตัว marker ไว้ในตัวแปร my_Marker
		position: my_Latlng,  // กำหนดไว้ที่เดียวกับจุดกึ่งกลาง
		map: map, // กำหนดว่า marker นี้ใช้กับแผนที่ชื่อ instance ว่า map
		//draggable:true, // กำหนดให้สามารถลากตัว marker นี้ได้
		title:"คลิกลากเพื่อหาตำแหน่งจุดที่ต้องการ!" // แสดง title เมื่อเอาเมาส์มาอยู่เหนือ
	});

	 var my_Point = my_Marker.getPosition(); 



	  geocoder.geocode({'latLng': my_Point}, function(results, status) {
                      if (status == GGM.GeocoderStatus.OK) {
                        if (results[1]) {
                            // แสดงข้อมูลสถานที่ใน textarea ที่มี id เท่ากับ place_value
                          $("#place_value").val(results[1].formatted_address); // 
                        }
                      } else {
                          // กรณีไม่มีข้อมูล
                        alert("Geocoder failed due to: " + status);
                      }
     });   




	
	// // กำหนด event ให้กับตัว marker เมื่อสิ้นสุดการลากตัว marker ให้ทำงานอะไร	
	// GGM.event.addListener(map, 'click', function() {

	

	// 	var my_Point = my_Marker.getPosition();  // หาตำแหน่งของตัว marker เมื่อกดลากแล้วปล่อย
 //        map.panTo(my_Point); // ให้แผนที่แสดงไปที่ตัว marker		
 //        $("#lat_value").val(my_Point.lat());  // เอาค่า latitude ตัว marker แสดงใน textbox id=lat_value
 //        $("#lon_value").val(my_Point.lng());  // เอาค่า longitude ตัว marker แสดงใน textbox id=lon_value 
 //        $("#zoom_value").val(map.getZoom());  // เอาขนาด zoom ของแผนที่แสดงใน textbox id=zoom_valu
        

       

	// });		
    GGM.event.addListener(map, "click", function(e) {
                    var latClick=e.latLng.lat(); // e.latLng.lat().toFixed(6);
                    var lonClick=e.latLng.lng();
                    var latlonClck=new GGM.LatLng(latClick,lonClick);
                    my_Marker.setPosition(latlonClck);
                    var my_Point = my_Marker.getPosition();  // หาตำแหน่งของตัว marker เมื่อกดลากแล้วปล่อย
                    map.panTo(my_Point);  // ให้แผนที่แสดงไปที่ตัว marker       
                    
                    // เรียกขอข้อมูลสถานที่จาก Google Map
                    geocoder.geocode({'latLng': my_Point}, function(results, status) {
                      if (status == GGM.GeocoderStatus.OK) {
                        if (results[1]) {
                            // แสดงข้อมูลสถานที่ใน textarea ที่มี id เท่ากับ place_value
                          $("#place_value").val(results[1].formatted_address); // 
                        }
                      } else {
                          // กรณีไม่มีข้อมูล
                        alert("Geocoder failed due to: " + status);
                      }
                    });     
                    
                    $("#lat_value").val(my_Point.lat());  // เอาค่า latitude ตัว marker แสดงใน textbox id=lat_value
                    $("#lon_value").val(my_Point.lng()); // เอาค่า longitude ตัว marker แสดงใน textbox id=lon_value 
                    $("#zoom_value").val(map.getZoom()); // เอาขนาด zoom ของแผนที่แสดงใน textbox id=zoom_value
     }); 

 

	// กำหนด event ให้กับตัวแผนที่ เมื่อมีการเปลี่ยนแปลงการ zoom
	GGM.event.addListener(map, 'zoom_changed', function() {
		$("#zoom_value").val(map.getZoom());   // เอาขนาด zoom ของแผนที่แสดงใน textbox id=zoom_value 	
	});

    

	   });
    }

}
$(function(){
	// ส่วนของฟังก์ชันค้นหาชื่อสถานที่ในแผนที่
	var searchPlace=function(){ // ฟังก์ชัน สำหรับคันหาสถานที่ ชื่อ searchPlace
		var AddressSearch=$("#namePlace").val();// เอาค่าจาก textbox ที่กรอกมาไว้ในตัวแปร
		if(geocoder){ // ตรวจสอบว่าถ้ามี Geocoder Object 
			geocoder.geocode({
				 address: AddressSearch // ให้ส่งชื่อสถานที่ไปค้นหา
			},function(results, status){ // ส่งกลับการค้นหาเป็นผลลัพธ์ และสถานะ
      			if(status == GGM.GeocoderStatus.OK) { // ตรวจสอบสถานะ ถ้าหากเจอ
					var my_Point=results[0].geometry.location; // เอาผลลัพธ์ของพิกัด มาเก็บไว้ที่ตัวแปร
					map.setCenter(my_Point); // กำหนดจุดกลางของแผนที่ไปที่ พิกัดผลลัพธ์
					my_Marker.setMap(map); // กำหนดตัว marker ให้ใช้กับแผนที่ชื่อ map					
					my_Marker.setPosition(my_Point); // กำหนดตำแหน่งของตัว marker เท่ากับ พิกัดผลลัพธ์
					$("#lat_value").val(my_Point.lat());  // เอาค่า latitude พิกัดผลลัพธ์ แสดงใน textbox id=lat_value
					$("#lon_value").val(my_Point.lng());  // เอาค่า longitude พิกัดผลลัพธ์ แสดงใน textbox id=lon_value 
					$("#zoom_value").val(map.getZoom()); // เอาขนาด zoom ของแผนที่แสดงใน textbox id=zoom_valu	
					$("#place_value").val(results[0].formatted_address); // 


				}else{
					// ค้นหาไม่พบแสดงข้อความแจ้ง
					alert("Geocode was not successful for the following reason: " + status);
					$("#namePlace").val("");// กำหนดค่า textbox id=namePlace ให้ว่างสำหรับค้นหาใหม่
				 }
			});
		}		
	}
	$("#SearchPlace").click(function(){ // เมื่อคลิกที่ปุ่ม id=SearchPlace ให้ทำงานฟังก์ฃันค้นหาสถานที่
		searchPlace();	// ฟังก์ฃันค้นหาสถานที่
	});
	$("#namePlace").keyup(function(event){ // เมื่อพิมพ์คำค้นหาในกล่องค้นหา
		if(event.keyCode==13){	// 	ตรวจสอบปุ่มถ้ากด ถ้าเป็นปุ่ม Enter ให้เรียกฟังก์ชันค้นหาสถานที่
			searchPlace();		// ฟังก์ฃันค้นหาสถานที่
		}		
	});

});
$(function(){
	// โหลด สคริป google map api เมื่อเว็บโหลดเรียบร้อยแล้ว
	// ค่าตัวแปร ที่ส่งไปในไฟล์ google map api
	// v=3.2&sensor=false&language=th&callback=initialize
	//	v เวอร์ชัน่ 3.2
	//	sensor กำหนดให้สามารถแสดงตำแหน่งทำเปิดแผนที่อยู่ได้ เหมาะสำหรับมือถือ ปกติใช้ false
	//	language ภาษา th ,en เป็นต้น
	//	callback ให้เรียกใช้ฟังก์ชันแสดง แผนที่ initialize	
	$("<script/>", {
	  "type": "text/javascript",
	  src: "http://maps.google.com/maps/api/js?v=3.2&sensor=false&language=th&callback=initialize"
	}).appendTo("body");	
});
</script>  

</body>
<input type="text" id="place_value" name="place_value" >

</html>