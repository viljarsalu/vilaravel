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
                <h3>{{ $value->content->title }} <small><?php echo Helper::get_time_ago(strtotime($value->created_at)); ?></small></h3>
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
                <!-- show comments -->
                @if ( count($value->comments) > 0 )
                <a href="#comments{{$value->id}}" data-toggle="collapse" data-target="#comments{{$value->id}}">comments ({{ count($value->comments) }})<span class="glyphicon glyphicon-chevron-down"></span></a>
                <div id="comments{{$value->id}}" class="collapse">
                    @foreach($value->comments as $key => $comment )
                    <div class="media">
                        <a class="media-left" href="#">
                            <img data-src="holder.js/64x64" src="..." alt="...">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading">{{ $comment->title }} <small><br />{{ $comment->author }} {{ $comment->created_at }}</small></h4>
                            {{ $comment->comment }}
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif

                <!-- last comment goes here -->
                <!-- <div class="media">
                    <a class="media-left" href="#">
                        <img data-src="holder.js/64x64" src="..." alt="...">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">Media heading <small>Today 09:45</small></h4>
                        last comment goes here
                    </div>
                </div> -->

                <!-- add comments -->
                <div class="comment__add">
                    <a href="#comment_form{{$value->id}}" class="btn btn-primary btn-sm center-block @if( Auth::guest() ) disabled @endif" data-toggle="collapse" data-target="#comment_form{{$value->id}}">{{ Lang::get('text.add_comment') }}</a>
                    <div id="comment_form{{$value->id}}" class="media collapse">
                        <a class="media-left" href="#">
                            <img data-src="holder.js/64x64" src="..." alt="user profile picture">
                        </a>
                        <div class="media-body">
                            {{ Form::open(array('url'=>'comments/add', 'role'=>'form', 'id'=>'add')) }}
                                {{ Form::hidden('item_id', $value->id, array('id'=>'item_id')) }}
                                {{ Form::label('comment_title', Lang::get('text.add_comment_title')) }}
                                {{ Form::text('comment_title', null, array('class'=>'form-control', 'placeholder'=>Lang::get('text.comment_title'),'id'=>'comment_title')) }}
                                {{ Form::label('comment', Lang::get('text.comment')) }}
                                {{ Form::textarea('comment', null, array('class'=>'form-control', 'placeholder'=>Lang::get('text.comment'),'id'=>'comment')) }}
                                {{ Form::submit(Lang::get('text.add_comment'), array('class'=>'btn btn-sm btn-primary'))}}
                                {{ Form::button(Lang::get('text.cancel'), array('class'=>'btn btn-sm btn-default', 'data-toggle'=>'collapse', 'data-target'=>'#comment_form'.$value->id))}}
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
            <!-- / comments -->
        </div>
    </div>
@endforeach
</div>

<style type="text/css">
    .votes a > span:last-child {
        margin-left: 10px;
    }
</style>