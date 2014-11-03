<div class="row">
	<div class="col-md-12">
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
</div>