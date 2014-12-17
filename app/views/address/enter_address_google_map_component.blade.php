@foreach($errors->all() as $error)
<p class="text-danger">{{ $error }}</p>
@endforeach

{{-- Form::open(array('url'=>'address/store', 'role'=>'form', 'id'=>'address')) --}}
    
    <!-- <div class="row">
        <div class="col-md-12">
            <h3>Add address</h3>
        </div>
    </div> -->

    <div class="row">
        <div class="col-md-12">
            <div id="locationField">
              <input class="form-control" name="autocomplete" id="autocomplete" placeholder="Enter your address" onchange="geolocate()" type="text"></input>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">

            <div class="form-group">
                <label>Street address</label>
                <input class="form-control" id="street_number" name="street_number" disabled="true"></input>
                <input class="form-control" id="route" name="route" disabled="true"></input>
            </div>

            <div class="form-group">
                <label for="locality">City</label>
                <input class="form-control" id="locality" name="locality" disabled="true"></input>
            </div>

            <div class="form-group">
                <label for="administrative_area_level_1">State</label>
                <input class="form-control" id="administrative_area_level_1" name="administrative_area_level_1" disabled="true"></input>
            </div>

            <div class="form-group">
                <label for="postal_code">Zip code</label>
                <input class="form-control" id="postal_code" name="postal_code" disabled="true"></input>
            </div>

            <div class="form-group">
                <label for="country">Country</label>
                <input class="form-control" id="country" name="country" disabled="true"></input>
            </div>

            <div class="form-group">
                <label for="lat">Latitude</label>
                <input class="form-control" id="lat" name="lat" />
            </div>
            
            <div class="form-group">
                <label for="lng">Longitude</label>
                <input class="form-control" id="lng" name="lng" />
            </div>
        </div>

        <div class="col-md-6">
            <div id="map-canvas">loading google map</div>
        </div>

    </div>

    {{-- Form::submit(Lang::get('text.save_address'), array('class'=>'btn btn-large btn-primary')) --}}

{{-- Form::close() --}}

<style>
#map-canvas {
    height: 300px;
}
</style>

<script>
var placeSearch, autocomplete, geocoder, map, marker;
var componentForm = {
    street_number               : 'short_name',
    route                       : 'long_name',
    locality                    : 'long_name',
    administrative_area_level_1 : 'short_name',
    country                     : 'long_name',
    postal_code                 : 'short_name'
};

function initialize() {
    geocoder = new google.maps.Geocoder();

    var latlng      = new google.maps.LatLng(58.3747,24.5136);
    var mapOptions  = {
        zoom    : 6,
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

    autocomplete = new google.maps.places.Autocomplete( ( document.getElementById('autocomplete') ), { types: ['geocode'] } );
    
    google.maps.event.addListener(autocomplete, 'place_changed', function() {
        fillInAddress();
    });

}

// set marker onto map
function setMarker(lat, lng) {
    //console.log(lat, lng);
    marker.setMap(null);
    var latlng      = new google.maps.LatLng(lat, lng);
    marker          = new google.maps.Marker({
        position    : latlng,
        map         : map,
        draggable   : false,
        animation   : google.maps.Animation.DROP,
        title       : "you are here"
    });

    setMarkerCenter();
}
// center map
function setMarkerCenter() {
    map.panTo(marker.getPosition());
    map.setZoom(15);
    //map.setCenter(center);
}

function fillInAddress() {
  // Get the place details from the autocomplete object.
    var place = autocomplete.getPlace();

    for (var component in componentForm) {
        document.getElementById(component).value = '';
        document.getElementById(component).disabled = false;
    }

    // Get each component of the address from the place details
    // and fill the corresponding field on the form.
    for (var i = 0; i < place.address_components.length; i++) {
        var addressType = place.address_components[i].types[0];
        if (componentForm[addressType]) {
          var val = place.address_components[i][componentForm[addressType]];
          document.getElementById(addressType).value = val;
        }
    }
    console.log('test', place.geometry.location.lat(),' / ',place.geometry.location.lng()) ;
    document.getElementById('lat').value = place.geometry.location.lat();
    document.getElementById('lng').value = place.geometry.location.lng();
    setMarker(place.geometry.location.lat(), place.geometry.location.lng());
}

// Bias the autocomplete object to the user's geographical location,
// as supplied by the browser's 'navigator.geolocation' object.
function geolocate() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition( function(position) {
        var geolocation     = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
        autocomplete.setBounds( new google.maps.LatLngBounds(geolocation,geolocation ));
    });
  }
}

function getGeolocation() {
    if(navigator.geolocation) {
        //navigator.geolocation.watchPosition(showPosition);
        navigator.geolocation.getCurrentPosition(showPosition,showError);
    }
    else {
        alert("Geolocation is not supported by this browser.");
    }
}
function showPosition(pos) {
    console.log("Latitude: "+pos.coords.latitude+"nLongitude: "+pos.coords.longitude);
}
function showError(error) {
    switch(error.code) {
    case error.PERMISSION_DENIED:
      console.log("User denied the request for Geolocation.")
      break;
    case error.POSITION_UNAVAILABLE:
      console.log("Location information is unavailable.")
      break;
    case error.TIMEOUT:
      console.log("The request to get user location timed out.")
      break;
    case error.UNKNOWN_ERROR:
      console.log("An unknown error occurred.")
      break;
    }
}

// toggle bounce funciton
/*function toggleBounce(e) {
    console.log(e);
    if (marker.getAnimation() != null) {
        marker.setAnimation(null);
    } else {
        marker.setAnimation(google.maps.Animation.BOUNCE);
     }
}*/

// load main google maps scripts
function loadScript() {
  var script    = document.createElement('script');
  script.type   = 'text/javascript';
  script.src    = 'https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&callback=initialize';
  document.body.appendChild(script);
}
window.onload   = loadScript;

</script>

<script type="text/javascript"> 
    getGeolocation()
</script>