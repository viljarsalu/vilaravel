
{{ $price->title }}
<div class="row">
{{ Form::open(array('url'=>'item/update', 'role'=>'form', 'id'=>'update', 'files'=>'true')) }}
    {{ Form::hidden('item_id', $item->id, array('id'=>'item_id')) }}
    {{ Form::hidden('asset_id', null, array('id'=>'asset_id')) }}
    <div class="col-sm-6 col-md-4">
        <div class="thumbnail">

            <span class="glyphicon glyphicon-fire"></span> {{ $price->title }}

            @include('address.show_google_map_component', array('address'=>$address))
            
        @if ($asset)
            <a href="#" data-toggle="modal" data-target="#gallery"><img src="{{ $asset->source }}" alt="{{$content->title}}" /></a>
        @else 
            <img data-src="holder.js/400x200" src="..." alt="...">
        @endif

            <div class="caption">
                <h3>{{ Form::text('title', $content->title, array('class'=>'form-control edit h3','id'=>'title')) }} <small><?php echo Helper::get_time_ago(strtotime($item->created_at)); ?></small></h3>
                <p>{{ Form::textarea('description', $content->description, array('class'=>'form-control edit','id'=>'description')) }}</p>
                {{--<p><a href="{{ URL::previous() }}">Go back</a></p>--}}
                <p>{{ Form::submit(Lang::get('text.save'), array('class'=>'btn btn-large btn-primary')) }}</p>
            </div>

            {{--
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
            --}}

        </div>
    </div>

</div>

{{ Form::close() }}

<div class="modal fade" id="gallery">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Gallery</h4>
      </div>
      <div class="modal-body">
        -kui valik tehtud tehakse paring ja ajaxiga ja saadakse margitud id ga asset tabelist
        -uus controller luua ala picture mis valjastab pildi source vastavalt id le
        @include('gallery.gallery_list_menu_component', array('assets'=>$gallery))
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->