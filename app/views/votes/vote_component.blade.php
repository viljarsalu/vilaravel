@if ( !$voterCheck && Auth::check() )

    {{ Form::open(array('url'=>'vote/like', 'class'=>'pull-left', 'role'=>'form', 'id'=>'like')) }}
        {{ Form::hidden('item_id', $item_id, array('id'=>'item_id')) }}
        <button>
            <span class="glyphicon glyphicon-thumbs-up"></span>
            <span>@if( $vote ) {{ $vote->like }} @endif</span>
        </button>
        {{ Form::close() }}

        {{ Form::open(array('url'=>'vote/dislike', 'role'=>'form', 'id'=>'dislike')) }}
        {{ Form::hidden('item_id', $item_id, array('id'=>'item_id')) }}
        
        <button>
            <span class="glyphicon glyphicon-thumbs-down"></span> 
            <span>@if( $vote ) {{ $vote->dislike }} @endif</span>
        </button>
    {{ Form::close() }}

@else

    <button disabled>
        <span class="glyphicon glyphicon-thumbs-up"></span> 
        <span>@if( $vote ) {{ $vote->like }} @endif</span>
    </button>

    <button disabled>
        <span class="glyphicon glyphicon-thumbs-down"></span> 
        <span>@if( $vote ) {{ $vote->dislike }} @endif</span>
    </button>

@endif