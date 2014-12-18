<div class="row">

    <div class="col-sm-6 col-md-4">
        <div class="thumbnail">

            <span class="glyphicon glyphicon-fire"></span> {{ $price->title }}

            @include('address.show_google_map_component', array('address'=>$address))
            
        @if ($asset)
            <a href="#/item/show/{{$item->id}}/{{ Str::slug($content->title) }}"><img src="{{ $asset->source }}" alt="{{$content->title}}" /></a>
        @else 
            <img data-src="holder.js/400x200" src="..." alt="...">
        @endif

            <div class="caption">
                <h3>{{ $content->title }} 
                    <small>
                @if ( $item->updated_at > $item->created_at)
                    updated <?php echo Helper::get_time_ago(strtotime($item->updated_at)); ?>
                @else 
                    created <?php echo Helper::get_time_ago(strtotime($item->created_at)); ?>
                @endif
                    </small>
                </h3>
                <p>{{ $content->description }}</p>
                <p><a href="{{ URL::previous() }}">Go back</a></p>
            </div>

            <!-- votes -->
                <div class="votes">
                @include('votes.vote_component', array('item_id'=>$item->id, 'vote'=>$vote, 'voterCheck'=>$voterCheck))
                </div>
            <!-- / votes -->

            <!-- comments -->
                <div class="comments">
                @include('comments.comment_component', array('item_id'=>$item->id, 'comments'=>$comments))
                </div>
            <!-- / comments -->

        </div>
    </div>

</div>