<div class="row">
@foreach($items as $key => $value)
    <div class="col-sm-6 col-md-4">
        <div class="thumbnail">
            <span class="glyphicon glyphicon-fire"></span> plan and price sample
                <a href="#" class="pull-right"><span class="glyphicon glyphicon-map-marker"></span>location</a>

                <img data-src="holder.js/300x300" alt="...">
                <div class="caption">
                    <h3>{{ $value->content->title }} <small>{{ $value->created_at }}</small></h3>
                    <p>{{ $value->content->description }}</p>
                </div>

                <!-- votes -->
                <div class="votes">
                    <a href="#"><span class="glyphicon glyphicon-thumbs-up"></span>40</a>
                    <a href="#"><span class="glyphicon glyphicon-thumbs-down"></span>10</a>
                </div>
                <!-- / votes -->

                <!-- comments -->
                <div class="comments">
                    <!-- show comments -->
                    <a href="#comments{{$value->id}}" data-toggle="collapse" data-target="#comments{{$value->id}}">comments <span class="glyphicon glyphicon-chevron-down"></span></a>
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

                    <!-- last comment goes here -->
                    <div class="media">
                        <a class="media-left" href="#">
                            <img data-src="holder.js/64x64" src="..." alt="...">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading">Media heading <small>Today 09:45</small></h4>
                            last comment goes here
                        </div>
                    </div>

                    <!-- add comments -->
                    <div class="comment__add">
                        <a href="#comment_form{{$value->id}}" class="btn btn-primary btn-sm center-block" data-toggle="collapse" data-target="#comment_form{{$value->id}}">{{ Lang::get('text.add_comment') }}</a>
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



<div class="row hide">
  <div class="col-sm-6 col-md-4">

    <div class="thumbnail">
        <span class="glyphicon glyphicon-fire"></span> plan and price sample
        <a href="#" class="pull-right"><span class="glyphicon glyphicon-map-marker"></span>location</a>

        <img data-src="holder.js/300x300" alt="...">
        <div class="caption">
            <h3>Title <small>4 Nov 2014</small></h3>
            <p>Content</p>
        </div>

    <!-- votes -->
        <div class="votes">
            <a href="#"><span class="glyphicon glyphicon-thumbs-up"></span>40</a>
            <a href="#"><span class="glyphicon glyphicon-thumbs-down"></span>10</a>
        </div>
    <!-- / votes -->

    <!-- comments -->
        <div class="comments">
            <!-- show comments -->
            <a href="#comments" data-toggle="collapse" data-target="#comments">3 comments <span class="glyphicon glyphicon-chevron-down"></span></a>
            <div id="comments" class="collapse">
                <div class="media">
                    <a class="media-left" href="#">
                        <img data-src="holder.js/64x64" src="..." alt="...">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">Media heading <small>Yesterday 12:45</small></h4>
                        comment goes here
                    </div>
                </div>
                <div class="media">
                    <a class="media-left" href="#">
                        <img data-src="holder.js/64x64" src="..." alt="...">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">Media heading <small>Yesterday 22:10</small></h4>
                        comment goes here
                    </div>
                </div>
            </div>

            <!-- last comment goes here -->
            <div class="media">
                <a class="media-left" href="#">
                    <img data-src="holder.js/64x64" src="..." alt="...">
                </a>
                <div class="media-body">
                    <h4 class="media-heading">Media heading <small>Today 09:45</small></h4>
                    last comment goes here
                </div>
            </div>

            <!-- add comments -->
            <div class="comment__add">
                <a href="#comment_form" class="btn btn-primary btn-sm center-block" data-toggle="collapse" data-target="#comment_form">{{ Lang::get('text.add_comment') }}</a>
                <div id="comment_form" class="media collapse">
                    <a class="media-left" href="#">
                        <img data-src="holder.js/64x64" src="..." alt="user profile picture">
                    </a>
                    <div class="media-body">
                        {{ Form::open(array('url'=>'comments/add', 'role'=>'form', 'id'=>'add')) }}
                            {{ Form::hidden('item_id', 1, array('id'=>'item_id')) }}
                            {{ Form::label('comment_title', Lang::get('text.add_comment_title')) }}
                            {{ Form::text('comment_title', null, array('class'=>'form-control', 'placeholder'=>Lang::get('text.comment_title'),'id'=>'comment_title')) }}
                            {{ Form::label('comment', Lang::get('text.comment')) }}
                            {{ Form::textarea('comment', null, array('class'=>'form-control', 'placeholder'=>Lang::get('text.comment'),'id'=>'comment')) }}
                            {{ Form::submit(Lang::get('text.add_comment'), array('class'=>'btn btn-sm btn-primary'))}}
                            {{ Form::button(Lang::get('text.cancel'), array('class'=>'btn btn-sm btn-default', 'data-toggle'=>'collapse', 'data-target'=>'#comment_form'))}}
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    <!-- / comments -->
    </div>

  </div>
</div>

<style type="text/css">
    .votes a > span:last-child {
        margin-left: 10px;
    }
</style>
<script src="http://imsky.github.io/holder/holder.js" />