function sendAndGet(url){
	$.ajax({
		url: url,
		beforeSend: function( xhr ) {
			xhr.overrideMimeType( "text/plain; charset=x-user-defined" );
		}
	})
	.done(function( data ) {
		if ( console && console.log ) {
			//console.log( "Sample of data:", data.slice( 0, 100 ) );
		}
		return data;
	});
}

function setEmail() {
	var nic="info";
	var at="@";
	var dom="homepage.com";
	document.getElementById('em').innerHTML = "<a href=mailto:"+nic+at+dom+">"+nic+at+dom+"</a>";
}

function loadScript(url) {
	var script    = document.createElement('script');
    script.type   = 'text/javascript';
    script.src    = url;
    document.body.appendChild(script);
}

$(document).ready(function(){
	setEmail();
});