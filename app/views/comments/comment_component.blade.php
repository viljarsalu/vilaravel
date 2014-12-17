@if ( $comments )

<a href="#comments{{$item->id}}" data-toggle="collapse" data-target="#comments{{$item->id}}">comments ({{ count($comments) }})<span class="glyphicon glyphicon-chevron-down"></span></a>
<div id="comments{{$item->id}}" class="collapse">
    @foreach($comments as $key => $comment )
    <div class="media">
        <!-- <a class="media-left" href="#">
            <img class="media-left" data-src="holder.js/64x64" src="..." alt="...">
        </a> -->
        <div class="media-body">
            <h4 class="media-heading">{{ $comment->title }} <small><br />{{ $comment->author }} wrote <?php echo Helper::get_time_ago(strtotime($comment->created_at)); ?></small></h4>
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
    <a href="#comment_form{{$item->id}}" class="btn btn-primary btn-sm center-block @if( Auth::guest() ) disabled @endif" data-toggle="collapse" data-target="#comment_form{{$item->id}}">{{ Lang::get('text.add_comment') }}</a>
    <div id="comment_form{{$item->id}}" class="media collapse">
        <a class="media-left" href="#">
            <img data-src="holder.js/64x64" src="..." alt="user profile picture">
        </a>
        <div class="media-body">
            {{ Form::open(array('url'=>'comments/add', 'role'=>'form', 'id'=>'add')) }}
                {{ Form::hidden('item_id', $item_id, array('id'=>'item_id')) }}
                {{ Form::label('comment_title', Lang::get('text.add_comment_title')) }}
                {{ Form::text('comment_title', null, array('class'=>'form-control', 'placeholder'=>Lang::get('text.comment_title'),'id'=>'comment_title')) }}
                {{ Form::label('comment', Lang::get('text.comment')) }}
                {{ Form::textarea('comment', null, array('class'=>'form-control', 'placeholder'=>Lang::get('text.comment'),'id'=>'comment')) }}
                {{ Form::submit(Lang::get('text.add_comment'), array('class'=>'btn btn-sm btn-primary'))}}
                {{ Form::button(Lang::get('text.cancel'), array('class'=>'btn btn-sm btn-default', 'data-toggle'=>'collapse', 'data-target'=>'#comment_form'.$item->id))}}
            {{ Form::close() }}
        </div>
    </div>
</div>