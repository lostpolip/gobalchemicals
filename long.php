<!DOCTYPE html>
<html>
    <head>
        <title>Place Autocomplete</title>
        <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
        <meta charset="utf-8">
        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script>
        	$(document).ready(function() {
                var location = $('#location').val();
                location = location.replace(/ /g, '+');
                $.ajax({
					url: "https://maps.googleapis.com/maps/api/geocode/json", 
					method: "GET",
					data: { 
						address : location,
						key : 'AIzaSyBBQWx9LHwmq7KUVzQr0JNfWmYnqhxUMz8',
					},
					success: function(result){
						var lat = result.results[0].geometry.location.lat;
						var lng = result.results[0].geometry.location.lng;
				    }
				});
            });
        </script>
    </head>
    <body>
    	<input id="location" value="สยามเซ็นเตอร์ Siam Tower ถนน พระราม 1 แขวง ปทุมวัน เขต ปทุมวัน กรุงเทพมหานคร 10330 ประเทศไทย"></input>
    </body>
</html>
