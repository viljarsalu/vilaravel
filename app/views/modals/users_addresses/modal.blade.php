{{ Form::open(array('url'=>'address/update', 'role'=>'form', 'id'=>'update', 'files'=>'true')) }}
<!-- Modal -->
<div class="modal fade" id="addresses" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
        <fieldset>
            <legend>Choose address</legend>
            <ul class="list-inline">
                @foreach( $addresses as $key=>$value )
                    <li>
                        <div style="border:1px solid #c8c8c8; padding:10px;">
                            <h3>{{ $value->title }}</h3>
                            <p>{{ $value->description }}</p>
                            {{ Form::label('plan_and_price', $value->title) }}
                            {{ Form::radio('plan_and_price', $value->id); }}
                        </div>
                    </li>
                @endforeach
            </ul>
        </fieldset>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
{{ Form::close() }}