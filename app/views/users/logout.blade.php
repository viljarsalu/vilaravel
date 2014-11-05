<h2>Oled turvaliselt välja logitud</h2>
<h3>Tule varsti tagasi!</h3>
<p>Sind suunatakse <span id='timer'></span> sekundi pärast avalehele.</p>

<script type="text/javascript">
	var sInt = setInterval(counter,1000);
	var idt = setTimeout(redirect, 5000);
	var el = document.getElementById('timer');
	var c = 0;
	function counter() {
		c++;
		el.innerHTML = c;
	}
	function redirect(){
		location.href="/";
	}
</script>