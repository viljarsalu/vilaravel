<div class="row">
	<div class="col-md-12">
		@if (Session::has('error'))
		  {{ trans(Session::get('reason')) }}
		@elseif (Session::has('success'))
		  An email with the password reset has been sent.
		@endif
		 
		{{ Form::open(array('url' => 'password/remind')) }}
		 
		  <p>{{ Form::label('email', 'Email') }}
		  {{ Form::text('email') }}</p>
		 
		  <p>{{ Form::submit('Submit') }}</p>
		 
		{{ Form::close() }}
	</div>
</div>