<a href="#" data-toggle="modal" data-target="#google_map{{$itemId}}" class="pull-right"><span class="glyphicon glyphicon-map-marker"></span> {{ $address->city }}, {{ $address->state }}, {{ $address->country }}</a>

<!-- Modal -->
<div class="modal fade" id="google_map{{$itemId}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
        https://www.google.com/maps?q={{ $address->lat }},{{ $address->lng }}
        <div id="map-canvas">loading google map</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>