<div class="row">
	<div class="col-md-12">
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
        	{{ Form::password('password', array('class'=>'form-control', 'placeholder'=>Lang::get('text.password'),'id'=>'password')) }}
		</div>

		<div class="form-group">
		 	{{ Form::label('password_confirmation', Lang::get('text.password_confirmation')) }}
        	{{ Form::password('password_confirmation', array('class'=>'form-control holo', 'placeholder'=>Lang::get('text.confirm_password'),'id'=>'password_confirmation')) }}
		</div>


		  {{ Form::submit(Lang::get('text.reset_password'), array('class'=>'btn btn-large btn-primary'))}}
		 
		{{ Form::close() }}
	</div>
</div>