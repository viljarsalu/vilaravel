<?php
$cat = "";
$catb = "";
?>
<h1 class="sr-only">My Dashboard</h1>
<div class="row">
	<div class="col-md-6">
		<h3>{{ Lang::get('text.my_posts') }}</h3>
		<ul class="list-unstyled">
		@foreach($rawData[0] as $k=>$fpost)
			@if( $k == 'posts')
				@if($fpost != 'empty')
					@foreach( $fpost as $i=>$p)
						@foreach( $p as $post )
			

			<li  style="background-color:#EBEBEB; padding:5px; margin-bottom:15px;">
				<p>
				<span class="label label-default">
				<?php
					if($cat != $post[0]['category'] ){
						echo Lang::get('text.'.$post[0]['category']);
					}
					$cat = $post[0]['category'];
				?>
				</span>
				<span class="pull-right">
					
				@if( $post[0]['old_post'] ) 
				<span class="text-warning"><b>{{ Lang::get('text.oldPost') }}</b></span> 
				<a href="#" id="edit_select-reuse-{{ $post[0]['post_id'] }}" class="btn btn-info btn-sm" data-type="select" data-pk="{{ $post[0]['post_id'] }}" data-url="{{ URL::action('KuulutusController@postReusePost') }}" data-title="Reuse" data-value="{{ $post[0]['post_id'] }}">{{ Lang::get('text.reusePost') }}</a>

				@endif
				</span>
				</p>
				<h3>
					<a href="/kuulutus/{{ $post[0]['category']}}/{{ $post[0]['product_tag']}}/{{ $post[0]['post_id'] }}/{{ Str::Slug($post[0]['title']) }}">{{ $post[0]['title'] }} ({{ $post[0]['price'] }}&euro;/{{ Lang::get('text.'.$post[0]['unit']) }})</a>
					<a href="/kuulutus/edit/{{ $post[0]['post_id'] }}"><span class="glyphicon glyphicon-pencil"></span></a>	
				</h3>
				<ul class="list-inline">
					<li><span class="glyphicon glyphicon-user"></span> {{ $post[0]['post_user']->first_name }} {{ $post[0]['post_user']->last_name }}</li>
					<li><span class="glyphicon glyphicon-envelope"></span> {{ $post[0]['post_user']->email }}</li>
					<li><span class="glyphicon glyphicon-earphone"></span> {{ $post[0]['post_user']->phone_number }}</li>
					<li><span class="glyphicon glyphicon-map-marker"></span> 
						@if ( $post[0]['post_user']->street ) {{ $post[0]['post_user']->street }}, @endif 
						@if ( $post[0]['post_user']->city ) {{ $post[0]['post_user']->city }},@endif 
						@if ( $post[0]['post_user']->county ) {{ $post[0]['post_user']->county }} @endif
					</li>
				</ul>
			</li>
						@endforeach
					@endforeach
				@else
				<span class="text-info">{{ Lang::get('text.no_offers') }}</span>
				@endif
			@endif
		@endforeach
		</ul>
	</div>

	<div class="col-md-6">
		<h3>{{ Lang::get('text.my_bookmarks') }}</h3>
		<ul class="list-unstyled">
		@foreach($rawData[0] as $k=>$data)
			@if( $k == 'bookmarks')
				@if($data != 'empty')
				<li>
					<h2>
					<?php
						if($catb != $data[0]['category'] ){
							echo Lang::get('text.'.$data[0]['category']);
						}
						$catb = $data[0]['category'];
					?>
					</h2>
					<h3>
						<a href="/kuulutus/{{ $data[0]['category'] }}/{{ $data[0]['product_tag'] }}/{{ $data[0]['post_id'] }}/{{ Str::Slug($data[0]['title']) }}">
						{{$data[0]['title']}} ({{ $data[0]['price'] }}&euro;/{{ Lang::get('text.'.$data[0]['unit']) }})</a>
					</h3>
					<ul class="list-inline">
						<li><span class="glyphicon glyphicon-user"></span> {{ $data[0]['post_user']->first_name }} {{ $data[0]['post_user']->last_name }}</li>
						<li><span class="glyphicon glyphicon-envelope"></span> {{ $data[0]['post_user']->email }}</li>
						<li><span class="glyphicon glyphicon-earphone"></span> {{ $data[0]['post_user']->phone_number }}</li>
						<li><span class="glyphicon glyphicon-map-marker"></span> 
							@if( $data[0]['post_user']->street ) {{ $data[0]['post_user']->street }}, @endif 
							@if( $data[0]['post_user']->city ) {{ $data[0]['post_user']->city }}, @endif
							@if( $data[0]['post_user']->county ){{ $data[0]['post_user']->county }} @endif
						</li>
					</ul>
				</li>
				@else
				<span class="text-info">{{ Lang::get('text.no_offers') }}</span>
				@endif
			@endif
		@endforeach
		</ul>
	</div>

	
</div>