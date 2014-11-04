<div class="row">
	<div class="col-md-12">
	{{ Form::open(array('url'=>'emails/send', 'role'=>'form', 'id'=>'sendmail')) }}
    
    <div class="form-group">
        {{ Form::label('first_name', Lang::get('text.first_name')) }}
        {{ Form::text('first_name', null, array('class'=>'form-control', 'placeholder'=>Lang::get('text.first_name'),'id'=>'first_name')) }}
    </div>
    <div class="form-group">
        {{ Form::label('last_name', Lang::get('text.last_name')) }}
        {{ Form::text('last_name', null, array('class'=>'form-control', 'placeholder'=>Lang::get('text.last_name'),'id'=>'last_name')) }}
    </div>
    <div class="form-group">
        {{ Form::label('email', Lang::get('text.email')) }}
        {{ Form::text('email', null, array('class'=>'form-control', 'placeholder'=>Lang::get('text.email_address'),'id'=>'email')) }}
    </div>

    {{ Form::submit(Lang::get('text.sign_up'), array('class'=>'btn btn-large btn-primary'))}}
    
{{ Form::close() }}
	</div>
</div>