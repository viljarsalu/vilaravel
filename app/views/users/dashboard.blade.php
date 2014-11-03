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

<div class="row">

	<div class="col-md-6">
		<h3>Remind password</h3>

		@if (Session::has('error'))
		  {{ trans(Session::get('reason')) }}
		@elseif (Session::has('success'))
		  An email with the password reset has been sent.
		@endif
		 
		{{ Form::open(array('url' => 'password/remind')) }}
		 
		<p>
			{{ Form::label('email', Lang::get('text.email')) }}
        	{{ Form::text('email', null, array('class'=>'form-control', 'placeholder'=>Lang::get('text.email_address'),'id'=>'email')) }}
		</p>
		 
			{{ Form::submit(Lang::get('text.send_reminder'), array('class'=>'btn btn-large btn-primary')) }}
		{{ Form::close() }}
	</div>

	<div class="col-md-6">
		<h3>Reset my password</h3>

		@if (Session::has('error'))
		  {{ trans(Session::get('reason')) }}
		@endif

		{{ Form::open( array( 'url' => array('password/reset','role'=>'form', 'id'=>'reset') ) ) }}
			<div class="form-group">
			  	{{ Form::label('email', Lang::get('text.email')) }}
	        	{{ Form::text('email', null, array('class'=>'form-control', 'placeholder'=>Lang::get('text.email_address'),'id'=>'email')) }}
			</div>

			<div class="form-group">
			  	{{ Form::label('password', Lang::get('text.password')) }}
	        	{{ Form::password('password', array('class'=>'form-control','id'=>'password')) }}
			</div>

			<div class="form-group">
			 	{{ Form::label('password_confirmation', Lang::get('text.password_confirmation')) }}
	        	{{ Form::password('password_confirmation', array('class'=>'form-control holo', 'placeholder'=>Lang::get('text.confirm_password'),'id'=>'password_confirmation')) }}
			</div>


		  	{{ Form::submit(Lang::get('text.reset_password'), array('class'=>'btn btn-large btn-primary'))}}
		 
		{{ Form::close() }}
	</div>
</div>