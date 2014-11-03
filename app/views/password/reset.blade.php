<div class="row">
	<div class="col-md-12">
		@if (Session::has('error'))
		  {{ trans(Session::get('reason')) }}
		@endif
		 
		{{ Form::open(array('url' => array('password/reset', $token))) }}
		 
		  <p>{{ Form::label('email', 'Email') }}
		  {{ Form::text('email') }}</p>
		 
		  <p>{{ Form::label('password', 'Password') }}
		  {{ Form::text('password') }}</p>
		 
		  <p>{{ Form::label('password_confirmation', 'Password confirm') }}
		  {{ Form::text('password_confirmation') }}</p>
		 
		  {{ Form::hidden('token', $token) }}
		 
		  <p>{{ Form::submit('Submit') }}</p>
		 
		{{ Form::close() }}
	</div>
</div>