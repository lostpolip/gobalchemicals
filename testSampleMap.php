<!-- <?php 
echo $_REQUEST['lat']; 
 echo $_REQUEST['lng'];
?> -->
<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Displaying text directions with <code>setPanel()</code></title>

    <script type="text/javascript" src="js/jquery.min.js"></script>
 
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
      #right-panel {
        font-family: 'Roboto','sans-serif';
        line-height: 30px;
        padding-left: 10px;
      }

      #right-panel select, #right-panel input {
        font-size: 15px;
      }

      #right-panel select {
        width: 100%;
      }

      #right-panel i {
        font-size: 12px;
      }
      #right-panel {
        height: 100%;
        float: right;
        width: 390px;
        overflow: auto;
      }
      #map {
        margin-right: 400px;
      }
      #floating-panel {
        background: #fff;
        padding: 5px;
        font-size: 14px;
        font-family: Arial;
        border: 1px solid #ccc;
        box-shadow: 0 2px 2px rgba(33, 33, 33, 0.4);
        display: none !important;
      }
      @media print {
        #map {
          height: 500px;
          margin: 0;
        }
        #right-panel {
          float: none;
          width: auto;
        }
      }
    </style>
  </head>
  <body>

    <div id="floating-panel">
      <strong>Start:</strong>
      <input id="start" value="<?php echo 'lat:13.9221481, lng:100.465985'; ?>">
      <input id="end" value="<?php echo 'lat:8.215278, lng:99.213333'; ?>">
    </div>
    <div id="right-panel"></div>
    <div id="map"></div>
    <script>

      function initMap() {
        var directionsDisplay = new google.maps.DirectionsRenderer;
        var directionsService = new google.maps.DirectionsService;
        var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 13.746742, lng: 100.534851},
          zoom: 20
        });
        directionsDisplay.setMap(map);
        directionsDisplay.setPanel(document.getElementById('right-panel'));

        var control = document.getElementById('floating-panel');
        control.style.display = 'block';
        map.controls[google.maps.ControlPosition.TOP_CENTER].push(control);
calculateAndDisplayRoute(directionsService, directionsDisplay);
        var onChangeHandler = function() {
          
        };
        document.getElementById('start').addEventListener('change', onChangeHandler);
        document.getElementById('end').addEventListener('change', onChangeHandler);
      }

      function calculateAndDisplayRoute(directionsService, directionsDisplay) {
        // var start = document.getElementById('start').value;
        // var end = document.getElementById('end').value;
        // var end = end.split(',');
        // console.log(parseFloat(end[0]));
        directionsService.route({
          origin: {lat:13.9221481, lng:100.465985},
          destination: {lat:8.215278, lng:99.213333},
          travelMode: google.maps.TravelMode.DRIVING
        }, function(response, status) {
          
          if (status === google.maps.DirectionsStatus.OK) {
            directionsDisplay.setDirections(response);

          } else {
            window.alert('Directions request failed due to ' + status);
          }
          console.log(response.routes[0].legs[0].distance.text);
        });
      }

    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBgSRcTdsVpnAkUacPJpJdk2TU9nz7qSIo&callback=initMap&language=th">
    </script>
  </body>
</html>




