<div class="row">
	<div class="col-md-6">
		<h1>Lorem ipsum</h1>
		<p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.</p>
		<p>At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.</p>
	</div>
	<div class="col-md-6">

	@if( Auth::guest() )
		<div>
			<h3>Login</h3>
			
            {{ Form::open( array('url'=>'users/signin', 'role'=>'form', 'class'=>'form-inline') ) }}
              <div class="form-group">
                {{ Form::text('email', null, array('class'=>'form-control input-sm', 'placeholder'=>Lang::get('text.email'), 'id'=>'email' ) ) }}
              </div>
              <div class="form-group">
                {{ Form::password('password', null, array('class'=>'form-control input-sm', 'id'=>'password' ) ) }}
              </div>
              {{ Form::submit( Lang::get('text.login'), array('class'=>'btn btn-default btn-sm') ) }}
            {{ Form::close() }}
           
		</div>
		<div style="text-align:center;">
			<h2>-OR-</h2>
		</div>
		<div>
			<p><strong>Forgot Password | Can't Log In | Reset your password</strong></p>
			{{ Form::open(array('url' => 'password/remind')) }}
			 
			<p>
				{{ Form::label('email', Lang::get('text.email')) }}
	        	{{ Form::text('email', null, array('class'=>'form-control', 'placeholder'=>Lang::get('text.email_address'),'id'=>'email')) }}
			</p>
			 
				{{ Form::submit(Lang::get('text.send_reminder'), array('class'=>'btn btn-large btn-primary')) }}
			{{ Form::close() }}
		</div>

	 @endif
	</div>
</div>