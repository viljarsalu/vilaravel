var placeSearch, autocomplete, geocoder, map, marker, latlng, lat, lng;
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
    latlng   = new google.maps.LatLng(lat, lng);
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

    /* google.maps.event.addListener(marker, 'click', toggleBounce);
   google.maps.event.addListener(marker, "dragend", function(event) { 
      setMarkerCenter( event.latLng.lat(), event.latLng.lng() );
    }); */

    autocomplete = new google.maps.places.Autocomplete( 
      ( document.getElementById('autocomplete') ), 
      { types: ['geocode'] }
    );
    
    google.maps.event.addListener(autocomplete, 'place_changed', function() {
        fillInAddress();
    });

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
    document.getElementById('lat').value = place.geometry.location.lat();
    document.getElementById('lng').value = place.geometry.location.lng();
    setMarker(place.geometry.location.lat(), place.geometry.location.lng());
    submitData();
    $('#updateAddress').submit();
}

function submitData(){
  var frm = $('#updateAddress');
      //console.log(frm, frm.attr('method'), frm.attr('action'));
      frm.submit(function (ev) {
          console.log('submit');
          $.ajax({
              type: frm.attr('method'),
              url:  frm.attr('action'),
              data: frm.serialize(),
              success: function (data) {
                $('#addresses_list > li > div').removeClass('selected');
                $('#addresses_list').append('<li><div class="selected"><p>'+data.street_address+'</p><input type="radio" value="'+data.address_id+'" name="existing_address_id" checked="checked" /></div></li>');
                
                // set new address
                var _addr = $('[data-target*="#google_map"]');
                _addr.html('<span class="glyphicon glyphicon-map-marker"></span>' + data.street_address + ", " + data.city);
                
              }
          });
          ev.preventDefault();
      });
}

// set marker onto map
function setMarker(lat, lng) {
    //console.log(lat, lng);
    marker.setMap(null);
    latlng          = new google.maps.LatLng(lat, lng);
    marker          = new google.maps.Marker({
        position    : latlng,
        map         : map,
        draggable   : false,
        animation   : google.maps.Animation.DROP,
        title       : "You Are Here"
    });

    setMarkerCenter();
}
// center map
function setMarkerCenter() {
    map.panTo(marker.getPosition());
    map.setZoom(15);
    //map.setCenter(center);
}



// Bias the autocomplete object to the user's geographical location,
// as supplied by the browser's 'navigator.geolocation' object.
//https://developers.google.com/maps/documentation/javascript/examples/places-autocomplete-addressform
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
//getGeolocation();

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
/*function loadScript() {
  var script    = document.createElement('script');
  script.type   = 'text/javascript';
  script.src    = 'https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&callback=isLoaded';//&callback=initialize
  document.body.appendChild(script);
}*/


$(document).ready(function(){
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
  // change address
  $('#google_map').find('input[name="existing_address_id"]').change(function(e){
    $.ajax({
      url: 'http://localhost:8000/address/get/' + this.value,
      beforeSend: function( xhr ) {
        xhr.overrideMimeType( "text/plain; charset=x-user-defined" );
      }
    })
    .done(function( data ) {
      if ( console && console.log ) {
        console.log( "Sample of data:", data.slice( 0, 100 ) );
      }
      // set new address
      var _addr = $('[data-target*="#google_map"]');
      //console.log(data, JSON.parse(data).lat, JSON.parse(data).lng);
      // reset marker
      setMarker(JSON.parse(data).lat, JSON.parse(data).lng);
      _addr.html('<span class="glyphicon glyphicon-map-marker"></span>' + JSON.parse(data).street_address + ", " + JSON.parse(data).city);//('src',JSON.parse(data).source);
    });
  //set address id
    $('#address_id').val(this.value);
  });
});

function isLoaded(){
  console.log("testin is loaded", $("#google_map"));

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
  // change address
  /*$('#google_map').find('input').change(function(e){
    $.ajax({
      url: 'http://localhost:8000/address/get/' + this.value,
      beforeSend: function( xhr ) {
        xhr.overrideMimeType( "text/plain; charset=x-user-defined" );
      }
    })
    .done(function( data ) {
      if ( console && console.log ) {
        console.log( "Sample of data:", data.slice( 0, 100 ) );
      }
      // set new address
      var _addr = $('[data-target*="#google_map"]');
      console.log(data);
      _addr.html('<span class="glyphicon glyphicon-map-marker"></span>' + JSON.parse(data).street_address + ", " + JSON.parse(data).city);//('src',JSON.parse(data).source);
    });
  //set address id
    $('#address_id').val(this.value);
  });*/
}