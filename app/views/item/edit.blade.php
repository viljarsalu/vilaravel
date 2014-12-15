<div class="row">
<!-- <p>item</p>
{{ $item }}
<hr />
<p>item address</p>
{{ $itemAddress }}
<hr />
<p>all users addresses</p>
{{ $myAddresses }}

<hr />
<p>price</p>
{{ $price }}

<hr />
<p>prices</p>
{{ $prices }}

<hr />
<p>asset</p>
{{ $asset }}

<hr />
<p>assets</p>
{{ $assets }} -->

<!--  start  -->
{{ Form::open(array('url'=>'item/update', 'role'=>'form', 'id'=>'update', 'files'=>'true')) }}
<div class="col-sm-6 col-md-4">
        <div class="thumbnail">
            @foreach ($price as $key => $prc)
                <a href="/address/change/{{ $usr }}" data-toggle="modal" data-target="#addresses">
                    <span class="glyphicon glyphicon-fire"></span> {{ $prc->title }}
                </a>
            @endforeach

            @foreach ($itemAddress as $key => $address)
                <a href="#" data-toggle="modal" data-target="#google_map" class="pull-right"><span class="glyphicon glyphicon-map-marker"></span> {{ $address->street_address }}</a>
                @include('modals.google_map.modal', array('lat'=>$address->lat, 'lng'=>$address->lng) )
                <!-- <a href="http://maps.googleapis.com/maps/api/directions/json?origin=6.914556,79.973194&destination={{ $address->lat }},{{ $address->lng }}&sensor=false" target="_blank">get distance</a> -->
            @endforeach

                
                {{-- @foreach ( $value->assets as $k =>$asset)
                    <a href="/item/show/{{ $value->id }}/{{ Str::slug($value->content->title) }}"><img src="{{ $asset->source }}" alt="..."></a>
                @endforeach --}}

                <div class="caption">
                    <h3>
                    {{ Form::text('title', $item->title, array('class'=>'form-control', 'id'=>'title')) }}
                    <small><?php echo Helper::get_time_ago(strtotime($item->created_at)); ?></small></h3>
                    <p>{{ Form::text('description', $item->description, array('class'=>'form-control', 'id'=>'description')) }}</p>
                    <p><a href="{{ URL::previous() }}">Go back</a></p>
                </div>

                <!-- votes -->
                <div class="votes">
                
                votes

                </div>
                <!-- / votes -->

            <!-- comments -->
                <div class="comments">
                    
                    comments
                    
                </div>
            <!-- / comments -->
        </div>
    </div>
    <div class="col-sm-6 col-md-4">
        {{ Form::submit(Lang::get('text.save'), array('class'=>'btn btn-large btn-primary')) }}
    </div>
<!--  end  -->

    
</div>

@include('modals.users_addresses.modal')


<style type="text/css">
    .votes a > span:last-child {
        margin-left: 10px;
    }
</style>
{{ Form::close() }}