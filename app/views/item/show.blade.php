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
                <h3>{{ $content->title }} <small><?php echo Helper::get_time_ago(strtotime($item->created_at)); ?></small></h3>
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


<style type="text/css">
    .votes a > span:last-child {
        margin-left: 10px;
    }
</style>
<script src="http://imsky.github.io/holder/holder.js" />