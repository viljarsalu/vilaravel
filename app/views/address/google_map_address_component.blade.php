@foreach($errors->all() as $error)
<p class="text-danger">{{ $error }}</p>
@endforeach

@if( count($addresses) > 1 && $edit_mode )
<div class="row">
    <div class="col-md-12">
        <ul class="list-inline">
            @foreach( $addresses as $key=>$address )
            <li>
                <div style="border:1px solid #c8c8c8; padding:10px;">
                    <p>{{ $address->street_address }}</p>
                    {{ Form::radio('existing_address_id', $address->id) }}
                </div>
            </li>
            @endforeach
        </ul>
    </div>
</div>
@endif

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