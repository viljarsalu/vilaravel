<div class="row">
@foreach($items as $key => $value)
    <div class="col-sm-6 col-md-4">
        <div class="thumbnail">

            @foreach ($value->prices as $key => $price)
                <span class="glyphicon glyphicon-fire"></span> {{ $price->title }}
            @endforeach
            
            @foreach ($value->addresses as $key => $address)
                <a href="#" data-toggle="modal" data-target="#google_map" class="pull-right" data-lat="{{ $address->lat }}" data-lng="{{ $address->lng }}"><span class="glyphicon glyphicon-map-marker"></span> {{ $address->street_address }}</a>
                @include('modals.google_map.modal', array('lat'=>$address->lat, 'lng'=>$address->lng) )
                <!-- <a href="http://maps.googleapis.com/maps/api/directions/json?origin=6.914556,79.973194&destination={{ $address->lat }},{{ $address->lng }}&sensor=false" target="_blank">get distance</a> -->
            @endforeach

            {{-- image place --}}
            @foreach ( $value->assets as $k =>$asset)
                <a href="/item/show/{{ $value->id }}/{{ Str::slug($value->content->title) }}"><img src="{{ $asset->source }}" alt="..."></a>
            @endforeach
            
            {{ $value->type }} / 
            @foreach( $value->labels as $key => $label )
             {{ $label->title }}
            @endforeach

            <div class="caption">
                <h3>{{ $value->content->title }} 
                    <small>
                    @if ( $value->updated_at > $value->created_at)
                        updated <?php echo Helper::get_time_ago(strtotime($value->updated_at)); ?>
                    @else 
                        created <?php echo Helper::get_time_ago(strtotime($value->created_at)); ?>
                    @endif
                    </small>
                </h3>
                <p>{{ $value->content->description }}</p>
                <p><a href="/item/show/{{ $value->id }}">{{ Lang::get('read_more') }}</a></p>
            </div>

            <!-- votes -->
            <div class="votes">
            
            @if ( count($value->votedusers) == 0 && Auth::check() )
                
                {{ Form::open(array('url'=>'vote/like', 'class'=>'pull-left', 'role'=>'form', 'id'=>'like')) }}
                    {{ Form::hidden('item_id', $value->id, array('id'=>'item_id')) }}
                    <button><span><span class="glyphicon glyphicon-thumbs-up"></span> 

                    @foreach ( $value->votes as $key => $vote)
                    <span>{{ $vote->like }}</span>
                    @endforeach
                    </button>
                    {{ Form::close() }}

                    {{ Form::open(array('url'=>'vote/dislike', 'role'=>'form', 'id'=>'dislike')) }}
                    {{ Form::hidden('item_id', $value->id, array('id'=>'item_id')) }}
                    
                    <button><span><span class="glyphicon glyphicon-thumbs-down"></span> 
                    @foreach ( $value->votes as $key => $vote)
                    <span>{{ $vote->dislike}}</span>
                    @endforeach
                    </button>
                {{ Form::close() }}

            @elseif( Auth::guest() )

                <button disabled><span><span class="glyphicon glyphicon-thumbs-up"></span> 
                @foreach ( $value->votes as $key => $vote)
                <span>{{ $vote->like }}</span>
                @endforeach
                </button>

                <button disabled><span><span class="glyphicon glyphicon-thumbs-down"></span> 
                @foreach ( $value->votes as $key => $vote)
                <span>{{ $vote->dislike}}</span>
                @endforeach
                </button>

            @else

                @foreach( $value->votedusers as $key => $vtdUsr )
                    @if( $vtdUsr->user_id != Auth::user()->id )
                        
                        {{ Form::open(array('url'=>'vote/like', 'class'=>'pull-left', 'role'=>'form', 'id'=>'like')) }}
                            {{ Form::hidden('item_id', $value->id, array('id'=>'item_id')) }}
                            <button><span><span class="glyphicon glyphicon-thumbs-up"></span> 

                            @foreach ( $value->votes as $key => $vote)
                            <span>{{ $vote->like }}</span>
                            @endforeach
                            </button>
                            {{ Form::close() }}

                            {{ Form::open(array('url'=>'vote/dislike', 'role'=>'form', 'id'=>'dislike')) }}
                            {{ Form::hidden('item_id', $value->id, array('id'=>'item_id')) }}
                            
                            <button><span><span class="glyphicon glyphicon-thumbs-down"></span> 
                            @foreach ( $value->votes as $key => $vote)
                            <span>{{ $vote->dislike}}</span>
                            @endforeach
                            </button>
                        {{ Form::close() }}

                    @else

                        <button disabled><span><span class="glyphicon glyphicon-thumbs-up"></span> 
                        @foreach ( $value->votes as $key => $vote)
                        <span>{{ $vote->like }}</span>
                        @endforeach
                        </button>

                        <button disabled><span><span class="glyphicon glyphicon-thumbs-down"></span> 
                        @foreach ( $value->votes as $key => $vote)
                        <span>{{ $vote->dislike}}</span>
                        @endforeach
                        </button>
                        
                    @endif
                    
                @endforeach

            @endif

            </div>
            <!-- / votes -->

        <!-- comments -->
            <div class="comments">
                @include('comments.comment_component', array('item_id'=>$value->id, 'comments'=>$value->comments))
            </div>
        <!-- / comments -->
        </div>
    </div>
@endforeach
</div>