<div class="row">
	<div class="col-md-12">
		<h1>Need to reset your password?</h1>
		
		<div style="border:1px solid red;">
			@if (Session::has('error'))
			<p style="color: red;">{{ Session::get('error') }}</p>
			@elseif (Session::has('status'))
			<p>{{ Session::get('status') }}</p>
			@endif
		</div>

		<div style="border:1px solid blue;">
			@if (Session::has('error'))
			  {{ trans(Session::get('reason')) }}
			@elseif (Session::has('success'))
			  An email with the password reset has been sent.
			@endif
		</div>
		 
		{{ Form::open(array('url' => 'password/remind')) }}
		 
		<p>
			{{ Form::label('email', Lang::get('text.email')) }}
        	{{ Form::text('email', null, array('class'=>'form-control', 'placeholder'=>Lang::get('text.email_address'),'id'=>'email')) }}
		</p>
		 
			{{ Form::submit(Lang::get('text.send_reminder'), array('class'=>'btn btn-large btn-primary')) }}
		{{ Form::close() }}

	</div>
</div>