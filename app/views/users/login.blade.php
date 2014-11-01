<div class="row">
	<!-- <div class="col-md-5">
		{{ Form::open(array('url'=>'users/signin', 'role'=>'form')) }}
	    <h2 class="form-signin-heading">Please Login</h2>
	 
	    {{ Form::text('email', null, array('class'=>'input-block-level', 'placeholder'=>'Email Address')) }}
	    {{ Form::password('password', array('class'=>'input-block-level', 'placeholder'=>'Password')) }}
	 
	    {{ Form::submit('Login', array('class'=>'btn btn-large btn-primary'))}}
	{{ Form::close() }}
	</div> -->
	<div class="col-md-12">
		<div class="content-body">
			<p>You have to log in 
			or
			{{ HTML::link('users/register', 'Sign Up Here') }}</p>
		</div>
	</div>
</div>