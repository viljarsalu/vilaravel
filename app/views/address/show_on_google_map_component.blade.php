<!-- Modal -->
<div class="modal fade" id="google_map" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">{{Lang::get('text.address')}}</h4>
      </div>
      <div class="modal-body">
        <div id="map-canvas">{{Lang::get('text.loading_map')}}</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">{{Lang::get('text.close')}}</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  // load main google maps scripts
  function loadScript() {
    var script    = document.createElement('script');
    script.type   = 'text/javascript';
    script.src    = 'https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&callback=initialize';//&callback=initialize
    document.body.appendChild(script);
  }
  window.onload   = loadScript;
</script>

{{ HTML::script('assets/js/show_address.js') }}