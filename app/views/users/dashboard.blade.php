<h1 class="sr-only">My Dashboard</h1>
<div class="row">
	<div class="col-md-12">
	
		@foreach( $user as $key => $value)
		<p>first name : {{ $value->first_name }}</p>
		<p>last name : {{ $value->last_name }}</p>
		<p>email: {{ $value->email }}</p>
		<p>password : {{ $value->password }}</p>
		@endforeach
	</div>
</div>