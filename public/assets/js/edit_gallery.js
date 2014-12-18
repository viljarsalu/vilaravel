$('#gallery').on('shown.bs.modal', function (e) {
    var _m = $(this);
    _m.find('input').change(function(e){
    	$('#asset_id').val(this.value);
    });
})