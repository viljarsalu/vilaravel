var map, marker, latlng, lat, lng;
var componentForm = {
    street_number               : 'short_name',
    route                       : 'long_name',
    locality                    : 'long_name',
    administrative_area_level_1 : 'short_name',
    country                     : 'long_name',
    postal_code                 : 'short_name'
};

function initialize() {
  latlng = new google.maps.LatLng(lat, lng);
  var mapOptions  = {
      zoom    : 17,
      center  : latlng
  };
  map     = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
  // add marker on the map
  marker  = new google.maps.Marker({
    position    : latlng,
    map         : map,
    draggable   : false,
    animation   : google.maps.Animation.DROP,
    title       : "You Are Here"
  });
}

// load main google maps scripts
function loadScript() {
  var script    = document.createElement('script');
  script.type   = 'text/javascript';
  script.src    = 'https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&callback=isLoaded';//&callback=initialize
  document.body.appendChild(script);
}

function isLoaded(){
  $("#google_map").on("shown.bs.modal", function(e) {
    var $invoker = $(e.relatedTarget);
    lat = $invoker.data('lat');
    lng = $invoker.data('lng');
    initialize();
    google.maps.event.trigger(map, "resize");
    return map.setCenter(latlng);
  });

  $("#google_map").on("hide.bs.modal", function(e) {
    $('#map-canvas').html('Loading map...');
  });
}

window.onload   = loadScript;