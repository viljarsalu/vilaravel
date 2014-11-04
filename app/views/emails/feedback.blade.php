<div class="row">
	<div class="col-md-12">
	{{ Form::open(array('url'=>'email/feedback', 'role'=>'form', 'id'=>'sendmail')) }}
    
    <div class="form-group">
        {{ Form::label('your_name', Lang::get('text.your_name')) }}
        {{ Form::text('your_name', null, array('class'=>'form-control', 'placeholder'=>Lang::get('text.your_name'),'id'=>'your_name')) }}
    </div>
    <div class="form-group">
        {{ Form::label('your_email', Lang::get('text.your_email')) }}
        {{ Form::text('your_email', null, array('class'=>'form-control', 'placeholder'=>Lang::get('text.your_email'),'id'=>'your_email')) }}
    </div>
    <div class="form-group">
        {{ Form::label('your_message', Lang::get('text.your_message')) }}
        {{ Form::textarea('your_message', null, array('class'=>'form-control', 'placeholder'=>Lang::get('text.your_message'),'id'=>'your_message')) }}
    </div>

    {{ Form::submit(Lang::get('text.send'), array('class'=>'btn btn-large btn-primary'))}}
    
{{ Form::close() }}
	</div>
</div>