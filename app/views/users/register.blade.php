    @foreach($errors->all() as $error)
        <p class="text-danger">{{ $error }}</p>
    @endforeach

    <h2>{{Lang::get('text.sign_up')}}</h2>

    {{ Form::open(array('url'=>'users/create', 'role'=>'form', 'id'=>'signup')) }}
    
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
    <div class="form-group">
        {{ Form::label('password', Lang::get('text.password')) }}
        {{ Form::password('password', array('class'=>'form-control', 'placeholder'=>Lang::get('text.password'),'id'=>'password')) }}
    </div>
    <div class="form-group">
        {{ Form::label('password_confirmation', Lang::get('text.password_confirmation')) }}
        {{ Form::password('password_confirmation', array('class'=>'form-control holo', 'placeholder'=>Lang::get('text.confirm_password'),'id'=>'password_confirmation')) }}
    </div>

    <hr style="border:1px solid red;" />
    
    <div class="radio">
      <label>
        {{ Form::radio('sex', 'female'); }}
        {{ Lang::get('text.female') }}
      </label>
    </div>
    <div class="radio">
      <label>
        {{ Form::radio('sex', 'male'); }}
        {{ Lang::get('text.male') }}
      </label>
    </div>

    <!-- birth data -->
    <div class="form-group">
        {{ Form::label('birth_time', Lang::get('text.birth_time') ) }}
        {{ Form::text('birth_time', null, array('class'=>'form-control', 'placeholder'=>Lang::get('text.birth_time'),'id'=>'birth_time')) }}

       <!--  {{ Form::label('birth_month', Lang::get('text.birth_month')) }}
        <select id="birth_month" name="birth_month">
        @for ($i = 0; $i < count(Config::get('pagesettings.months')); $i++ )
            <option value="{{ Config::get('pagesettings.months')[$i] }}">{{ Lang::get('text.' . Config::get('pagesettings.months')[$i]) }}</option>
        @endfor
        </select>

        {{ Form::label('birth_day', Lang::get('text.birth_day')) }}
        <select class="" id="birth_day" name="birth_day">
            <option value="0">{{ Lang::get('text.date') }}</option>
            @for ($i = 1; $i < 32; $i++)
            <option label="{{$i}}" value="{{$i}}">{{$i}}</option>
            @endfor
        </select>

        {{ Form::label('birth_year', Lang::get('text.birth_year')) }}
        <select class="" id="birth_year" name="birth_year">
            <option value="0">{{ Lang::get('text.year') }}</option>
            @for ($i = 2014; $i > 1904; $i--)
            <option label="{{$i}}" value="{{$i}}">{{$i}}</option>
            @endfor
         </select> -->
    </div>

    <hr style="border:1px solid red;" />
    
     @include('address.enter_address_google_map_component')

    {{ Form::submit(Lang::get('text.sign_up'), array('class'=>'btn btn-large btn-primary'))}}
    
{{ Form::close() }}