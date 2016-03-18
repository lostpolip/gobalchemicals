<!DOCTYPE html >
<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<style type="text/css">
html{
	padding:0px;
	margin:0px;
}
div#map_canvas{
	margin:auto;
	width:600px;
	height:550px;
	overflow:hidden;
}
</style>

</head>

<body>

<div id="map_canvas">
</div> 

<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=ABQIAAAAcNvUk-nhOGHxtqYjlYDTRRQIRG6yKtEoODg8BfMKCyHqWgeYjhTbSKxVXskDpcNKx0i7Msr1-E1jhg" type="text/javascript"></script>
<script type="text/javascript"> 
function initialize() { 
  if (GBrowserIsCompatible()) { 
	var map = new GMap2(document.getElementById("map_canvas")); 
	var center = new GLatLng(13.77436,100.53458); // การกำหนดจุดเริ่มต้น
	map.setCenter(center, 13);  // เลข 13 คือค่า zoom  สามารถปรับตามต้องการ 
	map.setUIToDefault(); 
	
	var marker = new GMarker(center, {draggable: true});  
    map.addOverlay(marker);
	 
	GEvent.addListener(marker, "dragend", function() {
		var point = marker.getPoint();
		map.panTo(point);

		$("#lat_value").val(point.lat());
		$("#lon_value").val(point.lng());
		$("#zoom_value").val(map.getZoom());

	});	 
	 
  } 
} 
</script> 
<script type="text/javascript" src="js/jquery-1.4.1.min.js"></script>
<script type="text/javascript">
$(function(){
	initialize();
	$(document.body).unload(function(){
			GUnload();
	});
});
</script>
<div id="showDD" style="margin:auto;padding-top:5px;width:600px;">
  <form id="form_get_detailMap" name="form_get_detailMap" method="post" action="">
    Latitude
    <input name="lat_value" type="text" id="lat_value" value="0" />
    Longitude
    <input name="lon_value" type="text" id="lon_value" value="0" />
  Zoom
  <input name="zoom_value" type="text" id="zoom_value" value="0" size="5" />
  <input type="submit" name="button" id="button" value="บันทึก" />
  </form>
</div>
</body>
</html>