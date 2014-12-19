<div class="row">
{{ Form::open(array('url'=>'item/update', 'role'=>'form', 'id'=>'update', 'files'=>'true')) }}
    {{ Form::hidden('item_id', $item->id, array('id'=>'item_id')) }}
    {{ Form::hidden('asset_id', $asset->id, array('id'=>'asset_id')) }}
    {{ Form::hidden('address_id', $address->id, array('id'=>'address_id')) }}
    <div class="col-sm-6 col-md-4">
        <p>
            {{ Form::label('public', 'Make public / unpublic') }}
            {{ Form::checkbox('public', null, $item->public, array('id'=>'public')) }}
        </p>
        <div class="thumbnail">

            <span class="glyphicon glyphicon-fire"></span> {{ $price->title }}
            <a href="#" data-toggle="modal" data-target="#address" class="pull-right"><span class="glyphicon glyphicon-map-marker"></span> {{ $address->street_address }},  {{ $address->city }}</a>
            {{--@include('address.show_google_map_component', array('address'=>$address))--}}
            
        @if ($asset)
            <a href="#" data-toggle="modal" data-target="#gallery" class="edit"><img src="{{ $asset->source }}" alt="{{$content->title}}" /></a>
        @else 
            <img data-src="holder.js/400x200" src="..." alt="...">
        @endif

            <div class="caption">
                <h3>{{ Form::text('title', $content->title, array('class'=>'form-control edit h3','id'=>'title')) }}
                    <small>
                @if ( $item->updated_at > $item->created_at)
                    updated <?php echo Helper::get_time_ago(strtotime($item->updated_at)); ?>
                @else 
                    created <?php echo Helper::get_time_ago(strtotime($item->created_at)); ?>
                @endif
                    </small>
                </h3>
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

<!-- Address -->
<div class="modal fade" id="address">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Address</h4>
      </div>
      <div class="modal-body">
        @include('address.google_map_address_component', array('edit_mode'=>true, 'addresses'=>$addresses))
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal --> 
<!-- Gallery -->
<div class="modal fade" id="gallery">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Gallery</h4>
      </div>
      <div class="modal-body">
        @include('gallery.gallery_list_menu_component', array('assets'=>$gallery))
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

