<!DOCTYPE html>
<html>
  <head>
    <title>Geocoding service</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <style>
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #map {
        height: 100%;
      }
      #floating-panel {
        position: absolute;
        top: 10px;
        left: 25%;
        z-index: 5;
        background-color: #fff;
        padding: 5px;
        border: 1px solid #999;
        text-align: center;
        font-family: 'Roboto','sans-serif';
        line-height: 30px;
        padding-left: 10px;
      }
    </style>
  </head>
  <body>
    <div id="floating-panel">
      <input id="address" type="textbox" value="Sydney, NSW">
      <input id="submit" type="button" value="Geocode">
    </div>
    <div id="map"></div>
    <script>

function getQueryVariable(variable, url) {
  var query = url.split('?');
  query = query[1].split('&');
  query = query[0].replace('ll=', '');
  query = query.split(',');
  return query;
}


      function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 17.970619, lng: 102.618526},
          zoom: 15
        });
        var geocoder = new google.maps.Geocoder();

        document.getElementById('submit').addEventListener('click', function() {
          geocodeAddress(geocoder, map);
        });
      }

      function geocodeAddress(geocoder, resultsMap) {
        var geocode = getQueryVariable("ll", resultsMap.mapUrl);
        console.log(resultsMap.mapUrl);
        var address = document.getElementById('address').value;
        geocoder.geocode({'address': address}, function(results, status) {
          if (status === google.maps.GeocoderStatus.OK) {
            resultsMap.setCenter(results[0].geometry.location);
            var marker = new google.maps.Marker({
              map: resultsMap,
              position: results[0].geometry.location
            });
            // window.location.href = 'http://localhost/gobalchemicals/testSampleMap.php?lat=' + geocode[0] + '&lng=' + geocode[1];
          } else {
            alert('Geocode was not successful for the following reason: ' + status);
          }
        });
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBgSRcTdsVpnAkUacPJpJdk2TU9nz7qSIo&callback=initMap&language=th">
    </script>
  </body>
</html>