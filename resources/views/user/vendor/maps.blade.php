<style type="text/css">
   #map-canvas {
   margin: 0;
   padding: 0;
   height: 100%;
   }

   .gm-style-mtc {
  display: none;
}
</style>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAnsrr4j7KEgyMbE9Nc0AE2L2cwYyK9Cio&v=3.exp&language=id&region=ID&libraries=places"></script>
<input id="pac-input" class="controls form-control" type="text" placeholder="Search Box" style="width: 300px;
   height: 27px;
   margin-top: 10px;
   border-radius: 4px;">
<div class="container" id="map-canvas" style="height:400px;"></div>
<script type="text/javascript">
   ready(function(){
      let longitude = 106.794243;
      let latitude = -6.402484;

      let labels = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
      let labelIndex = 0;
      var markers = [];
     function init() {

      let myLatLng = {lat: latitude, lng: longitude};

      let map = new google.maps.Map(document.getElementById('map-canvas'), {
           center: {
             lat: latitude,
             lng: longitude
           },
           zoom: 18
      });

      let marker = new google.maps.Marker();   
   
      markers.push(marker);
      let searchBox = new google.maps.places.SearchBox(document.getElementById('pac-input'));
      map.controls[google.maps.ControlPosition.TOP_CENTER].push(document.getElementById('pac-input'));
      google.maps.event.addListener(searchBox, 'places_changed', function() {
        searchBox.set('map', null);
   
   
        let places = searchBox.getPlaces();
   
        let bounds = new google.maps.LatLngBounds();
        let i, place;
        for (i = 0; place = places[i]; i++) {
          (function(place) {
            let marker = new google.maps.Marker({
   
              position: place.geometry.location
            });
            marker.bindTo('map', searchBox, 'map');
            google.maps.event.addListener(marker, 'map_changed', function() {
              if (!this.getMap()) {
                this.unbindAll();
              }
            });
            bounds.extend(place.geometry.location);
   
   
          }(place));
   
        }
        map.fitBounds(bounds);
        searchBox.set('map', map);
        map.setZoom(Math.min(map.getZoom(),12));
   
      });
   
      google.maps.event.addListener(map, 'click', function(event) {
         let latitude = event.latLng.lat();
         let longitude = event.latLng.lng();
         let url =  "https://maps.googleapis.com/maps/api/geocode/json?latlng="+latitude+","+longitude+"&key=AIzaSyAnsrr4j7KEgyMbE9Nc0AE2L2cwYyK9Cio";
         
         $.ajax({
            type: "GET",
            url: url,
            dataType: 'json',
            success: function(data){
               let alamat = data.results[0].formatted_address;
               let long = data.results[0].geometry.location.lng;
               let lat = data.results[0].geometry.location.lat;
               $("#map_street").val(alamat);
               $("#lat").val(lat);
               $("#long").val(long);
               var newMap = { lat: lat, lng: long };
               setMapOnAll(null);
               addMarker(newMap, map);               
            }
         });
     });


      function addMarker(location, map) {
        
        var marker = new google.maps.Marker({
          position: location,
          label: labels[labelIndex++ % labels.length],
          map: map
        });

        markers.push(marker);
      }

      function setMapOnAll(map) {
        for (let i = 0; i < markers.length; i++) {
          markers[i].setMap(map);
        }
      }
   
    }
    google.maps.event.addDomListener(window, 'load', init);
   });
   
   
</script>