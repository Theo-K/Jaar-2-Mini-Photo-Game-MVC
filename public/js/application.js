var map;
var marker;
var disabled = false;

function initialize() {
      var mapOptions = {
        center: { lat: 52.100833, lng: 5.646111 },
        zoom: 7
      };
      map = new google.maps.Map(document.getElementById('map-canvas'),
          mapOptions);

      function placeMarker(location) {
        if ( !disabled) {
          if ( marker ) {
            marker.setPosition(location);
          } else {
            marker = new google.maps.Marker({
              position: location,
              icon: 'http://maps.google.com/mapfiles/ms/icons/blue-dot.png',
              map: map
            });
          }
          marker.setAnimation(google.maps.Animation.BOUNCE);
          setTimeout(function(){marker.setAnimation(null)},500);
          
        }
      }

        google.maps.event.addListener(map, 'click', function(event) {
        placeMarker(event.latLng);
      });
    }
    google.maps.event.addDomListener(window, 'load', initialize);

$(function() {

    // if #javascript-ajax-button exists
    if ($('#guess').length !== 0) {

        $('#guess').on('click', function(){

            // send an ajax-request to this URL: current-server.com/songs/ajaxGetStats
            // "url" is defined in views/_templates/footer.php

            photoid = $('#photo').data('photoid');

            $.ajax(url + "/game/checkLocation/" + photoid )
                .done(function(result) {
                    // this will be executed if the ajax-call was successful
                    // here we get the feedback from the ajax-call (result) and show it in #javascript-ajax-result-box
                    var location = $.parseJSON(result);

                    var photoloc = new google.maps.LatLng(51.817583333333, 4.7743138888889);
                    var markerloc = marker.getPosition();

                    var photomarker = new google.maps.Marker({
                      position: photoloc,
                      icon: 'http://maps.google.com/mapfiles/ms/icons/pink-dot.png',
                      map: map
                    });
                    disabled = true;

                    var line = [
                      photoloc,
                      markerloc
                    ];

                    var markerline = new google.maps.Polyline({
                      path: line,
                      geodesic: true,
                      strokeColor: '#FF0000',
                      strokeOpacity: 1.0,
                      strokeWeight: 4
                      });

                    markerline.setMap(map);

                    var distance = google.maps.geometry.spherical.computeDistanceBetween(photoloc, markerloc);
                    console.log(Math.floor(distance / 1000));
                    
                    window.location.assign(url + "game/score/" + photoid + "/" + distance);
                    
                })
                .fail(function() {
                    // this will be executed if the ajax-call had failed
                })
                .always(function() {
                    // this will ALWAYS be executed, regardless if the ajax-call was success or not
                });
        });
    }

});
