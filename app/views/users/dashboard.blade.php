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

<!-- users items -->
<div class="row">
	<div class="col-md-12">
	<h2>My All Items</h2>
		<ul class="list-inline">	
		@foreach ($items as $key => $value)
			<li>
				<div style="border:1px solid #c8c8c8; padding:10px; margin-top:10px;">
					<h3>
						{{ $value->content->title }}
						<small>created at <?php echo Helper::get_time_ago(strtotime($value->created_at));?></small>
						<small>updated at <?php echo Helper::get_time_ago(strtotime($value->updated_at));?></small>
					</h3>
					<p>{{ $value->content->description }} 
					<a href="/item/show/{{ $value->id }}">read more</a> 
					<a href="/item/edit/{{ $value->id }}" class="edit">edit <span class="glyphicon glyphicon-pencil"></span></a></p>
				</div>
			</li>
		@endforeach
		</ul>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<h3>Gallery</h3>
		
		<ul class="list-inline">
		@foreach ($assets as $key => $asset)
			<li><img src="{{ $asset->source }}"/></li>
		@endforeach
		</ul>

	</div>
</div>

<div class="row">

	<div class="col-md-6">
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