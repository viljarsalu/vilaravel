$('#gallery').find('input').change(function(e){
	$.ajax({
		url: 'http://localhost:8000/assets/img/' + this.value,
		beforeSend: function( xhr ) {
			xhr.overrideMimeType( "text/plain; charset=x-user-defined" );
		}
	})
	.done(function( data ) {
		if ( console && console.log ) {
			console.log( "Sample of data:", data.slice( 0, 100 ) );
		}
		// set new image
		var _img = $('.thumbnail a > img');
		_img.attr('src',JSON.parse(data).source);
	});
	//set asset id
	$('#asset_id').val(this.value);
});