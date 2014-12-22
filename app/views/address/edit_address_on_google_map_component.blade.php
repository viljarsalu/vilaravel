<!-- Modal -->
<div class="modal fade" id="google_map" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">{{Lang::get('text.address')}}</h4>
      </div>
      <div class="modal-body">

        <div class="row">
          <div class="col-md-12">

            <ul class="list-inline addresses_list" id="addresses_list">
                @foreach( $addresses as $key=>$value )
                <li>
                    <div @if( $address->id == $value->id) class="selected" @endif >
                        <p>{{ $value->street_address }} {{ $address->id}}</p>
                        @if( $address->id == $value->id) 
                          {{ Form::radio('existing_address_id', $value->id, true) }}
                        @else
                          {{ Form::radio('existing_address_id', $value->id) }}
                        @endif
                        
                    </div>
                </li>
                @endforeach
            </ul>

          </div>
        </div>
        
        <div class="row">
            <div class="col-md-12">
                <div id="locationField">
                  <input class="form-control" name="autocomplete" id="autocomplete" placeholder="Enter your address" onchange="geolocate()" type="text"></input>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">

              {{ Form::open(array('url'=>'address/updateaddress', 'role'=>'form', 'id'=>'updateAddress')) }}
              {{ Form::hidden('user_id', $userId, array('id'=>'user_id')) }}
              {{ Form::hidden('item_id', $itemId, array('id'=>'item_id')) }}
                
                <div class="form-group">
                    <label>Street address</label>
                    <input type="text" class="form-control" id="street_number" name="street_number" disabled="true"></input>
                    <input type="text" class="form-control" id="route" name="route" disabled="true"></input>
                </div>

                <div class="form-group">
                    <label for="locality">City</label>
                    <input type="text" class="form-control" id="locality" name="locality" disabled="true"></input>
                </div>

                <div class="form-group">
                    <label for="administrative_area_level_1">State</label>
                    <input type="text" class="form-control" id="administrative_area_level_1" name="administrative_area_level_1" disabled="true"></input>
                </div>

                <div class="form-group">
                    <label for="postal_code">Zip code</label>
                    <input type="text" class="form-control" id="postal_code" name="postal_code" disabled="true"></input>
                </div>

                <div class="form-group">
                    <label for="country">Country</label>
                    <input type="text" class="form-control" id="country" name="country" disabled="true"></input>
                </div>

                <div class="form-group">
                    <label for="lat">Latitude</label>
                    <input type="text" class="form-control" id="lat" name="lat" />
                </div>
                
                <div class="form-group">
                    <label for="lng">Longitude</label>
                    <input type="text" class="form-control" id="lng" name="lng" />
                </div>

              {{ Form::close() }}

            </div>

            <div class="col-md-6">
                <div id="map-canvas">loading google map</div>
            </div>

        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">{{Lang::get('text.close')}}</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  function loadScript() {
    var script    = document.createElement('script');
    script.type   = 'text/javascript';
    script.src    = 'https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&callback=loadEditJs';//&callback=initialize
    document.body.appendChild(script);
  }
  // trigger when page onloaded
  window.onload = loadScript;

  function loadEditJs(){
    loadScript('http://localhost:8000/assets/js/edit_address.js')
  }
</script>