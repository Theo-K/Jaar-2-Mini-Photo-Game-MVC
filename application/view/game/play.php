<div class="container">
<head>
  <style type="text/css">
    html, body { height: 100%; margin: 0; padding: 0;} 
    #map-canvas { height: 450px; width: 450px; margin: 0; padding: 0;}
  </style>
    <script type="text/javascript"
    src="https://maps.googleapis.com/maps/api/js?key=   
    AIzaSyDyQT45f7BezdUWo73hocOBy-OvuA5k2No">
  </script>
  <script type="text/javascript">
    function initialize() {
     
      var myLatlng = new google.maps.LatLng(52.100833, 5.648111);
      var marker;
      var mapOptions = {
        zoom: 7,
        center: myLatlng
      }
      var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

      google.maps.event.addListener(map, 'click', function(event) {
        addMarker(event.latLng);
      });

      function addMarker(location) {
        if (marker) {
          marker.setPosition(location);
        } else {
          marker = new google.maps.Marker({
            map: map,
            draggable: true,
            position: location
          });
        }

        console.log(marker.getPosition());
      }
    }
    google.maps.event.addDomListener(window, 'load', initialize);
  </script>
</head>
<body>
  <div id="map-canvas"></div>
  <img src="<?php echo URL . 'uploads/'; if (isset($this->game->file)) echo htmlspecialchars($this->game->file, ENT_QUOTES, 'UTF-8'); ?>">
</body>
</div>