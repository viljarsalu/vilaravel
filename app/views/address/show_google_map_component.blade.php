<a href="#" data-toggle="modal" data-target="#google_map" class="pull-right"><span class="glyphicon glyphicon-map-marker"></span> {{ $address->city }}, {{ $address->state }}, {{ $address->country }}</a>

<!-- Modal -->
<div class="modal fade" id="google_map" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
        https://www.google.com/maps?q={{ $address->lat }},{{ $address->lng }}
        <div id="map-canvas">loading google map</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<style>
#map-canvas {
    height: 300px;
}
</style>

<script>
var map, marker;
function initialize() {

    var latlng      = new google.maps.LatLng({{ $address->lat }},{{ $address->lng }});
    var mapOptions  = {
        zoom    : 16,
        center  : latlng
    };

        map     = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
        // add marker on the map
        marker  = new google.maps.Marker({
        position    : latlng,
        map         : map,
        draggable   : false,
        animation   : google.maps.Animation.DROP,
        title       : "you are here"
    });

    /* google.maps.event.addListener(marker, 'click', toggleBounce);
   google.maps.event.addListener(marker, "dragend", function(event) { 
      setMarkerCenter( event.latLng.lat(), event.latLng.lng() );
    }); */

    //autocomplete = new google.maps.places.Autocomplete( ( document.getElementById('autocomplete') ), { types: ['geocode'] } );
    
    /*google.maps.event.addListener(autocomplete, 'place_changed', function() {
        fillInAddress();
    });*/
    
    // google map into modal issue fix
    // When modal window is open, this script resizes the map and resets the map center
    $("#google_map").on("shown.bs.modal", function(e) {
      google.maps.event.trigger(map, "resize");
      return map.setCenter(latlng);
    });

}

// load main google maps scripts
function loadScript() {
  var script    = document.createElement('script');
  script.type   = 'text/javascript';
  script.src    = 'https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&callback=initialize';
  document.body.appendChild(script);
}
window.onload   = loadScript;

</script>