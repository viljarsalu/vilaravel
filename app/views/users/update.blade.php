{{ Form::open(array('url'=>'users/update', 'role'=>'form')) }}
    <h2 class="form-signup-heading">{{ Lang::get('text.edit_your_contact') }}</h2>
 
    <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>

    <div style="background-color:#f0f0f0; padding:10px;">
        <div class="form-group">
            <label for="firstname">{{ Lang::get('text.first_name') }}</label>
            {{ Form::text('firstname', $post[0]->first_name, array('class'=>'form-control', 'placeholder'=>Lang::get('text.first_name'),'id'=>'firstname')) }}
        </div>
        <div class="form-group">
            <label for="lastname">{{ Lang::get('text.last_name') }}</label>
            {{ Form::text('lastname',  $post[0]->last_name, array('class'=>'form-control', 'placeholder'=>Lang::get('text.last_name'),'id'=>'lastname')) }}
        </div>
        <div class="form-group">
            <label for="email">{{ Lang::get('text.email_address') }}</label>
            {{ Form::text('email',  $post[0]->email, array('class'=>'form-control', 'placeholder'=>Lang::get('text.email_address'),'id'=>'email')) }}
        </div>
        <div class="radio">
            <label>
                <input type="radio" name="sex" id="female" @if ($post[0]->sex == 'female') checked="true" @endif value="female"> {{ Lang::get('text.female') }}
            </label>
        </div>

        <div class="radio">
            <label>
                <input type="radio" name="sex" id="male" @if ($post[0]->sex == 'male') checked="true" @endif value="male"> {{ Lang::get('text.male') }}
            </label>
        </div>
        <div class="form-group">
            <select id="birth_month" name="birth_month">
                <option value="0">{{ Lang::get('text.month') }}</option>
                <option label="Jan" value="1"   @if ($post[0]->birth_month == 1) selected="selected" @endif>{{ Lang::get('text.january') }}</option>
                <option label="Feb" value="2"   @if ($post[0]->birth_month == 2) selected="selected" @endif>{{ Lang::get('text.february') }}</option>
                <option label="Mar" value="3"   @if ($post[0]->birth_month == 3) selected="selected" @endif>{{ Lang::get('text.march') }}</option>
                <option label="Apr" value="4"   @if ($post[0]->birth_month == 4) selected="selected" @endif>{{ Lang::get('text.april') }}</option>
                <option label="May" value="5"   @if ($post[0]->birth_month == 5) selected="selected" @endif>{{ Lang::get('text.may') }}</option>
                <option label="Jun" value="6"   @if ($post[0]->birth_month == 6) selected="selected" @endif>{{ Lang::get('text.jun') }}</option>
                <option label="Jul" value="7"   @if ($post[0]->birth_month == 7) selected="selected" @endif>{{ Lang::get('text.july') }}</option>
                <option label="Aug" value="8"   @if ($post[0]->birth_month == 8) selected="selected" @endif>{{ Lang::get('text.august') }}</option>
                <option label="Sep" value="9"   @if ($post[0]->birth_month == 9) selected="selected" @endif>{{ Lang::get('text.september') }}</option>
                <option label="Oct" value="10"  @if ($post[0]->birth_month == 10) selected="selected" @endif>{{ Lang::get('text.october') }}</option>
                <option label="Nov" value="11"  @if ($post[0]->birth_month == 11) selected="selected" @endif>{{ Lang::get('text.november') }}</option>
                <option label="Dec" value="12"  @if ($post[0]->birth_month == 12) selected="selected" @endif>{{ Lang::get('text.december') }}</option>
            </select>

            <select class="" id="birth_day" name="birth_day">
                <option value="0">{{ Lang::get('text.date') }}</option>
                @for ($i = 1; $i < 32; $i++)
                <option label="{{$i}}" value="{{$i}}" @if($i == $post[0]->birth_day) selected="selected" @endif >{{$i}}</option>
                @endfor
            </select>
            <select class="" id="birth_year" name="birth_year">
                <option value="0">{{ Lang::get('text.year') }}</option>
                @for ($i = 2014; $i > 1904; $i--)
                <option label="{{$i}}" value="{{$i}}" @if($i == $post[0]->birth_year) selected="selected" @endif >{{$i}}</option>
                @endfor
             </select>
        </div>

        <div class="form-group">
            <label for="vendor">{{ Lang::get('text.vendor') }}</label>
            {{ Form::text('vendor', $post[0]->vendor, array('class'=>'form-control', 'placeholder'=>Lang::get('text.vendor'),'id'=>'vendor')) }}
        </div>
        <div class="form-group">
            <label for="phone_number">{{ Lang::get('text.phone_number') }}</label>
            {{ Form::text('phone_number',  $post[0]->phone_number, array('class'=>'form-control', 'placeholder'=>Lang::get('text.phone_number') ,'id'=>'phone_number')) }}
        </div>
    </div>

    <!-- address block -->
    <div style="background-color:#f0f0f0; padding:10px;">
        <p class="register__modal--optionals">
            <a id="show-optionals-fields" data-toggle="collapse" href="#optionalsFields" class="pull-right">
                {{ Lang::get('text.optional_registration_fields') }}
                <span class="glyphicon glyphicon-chevron-down"></span>
            </a>
        </p>
        <div id="optionalsFields" class="collapse">

            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="street">{{ Lang::get('text.street') }}</label>
                        {{ Form::text('street',  $post[0]->street, array('class'=>'form-control', 'placeholder'=>Lang::get('text.street'),'id'=>'street')) }}
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="city">{{ Lang::get('text.city') }}</label>
                        {{ Form::text('city',  $post[0]->city, array('class'=>'form-control', 'placeholder'=>Lang::get('text.city'),'id'=>'city')) }}
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="county">{{ Lang::get('text.county') }}</label>
                        <br>
                            {{ Form::select('county', array (
                                'Harjumaa'      => 'Harjumaa', 
                                'Läänemaa'      => 'Läänemaa', 
                                'Saaremaa'      => 'Saaremaa', 
                                'Hiiumaa'       => 'Hiiumaa', 
                                'Lääne-Virumaa' => 'Lääne-Virumaa', 
                                'Tartumaa'      => 'Tartumaa', 
                                'Ida-Virumaa'   => 'Ida-Virumaa', 
                                'Põlvamaa'      => 'Põlvamaa', 
                                'Valgamaa'      => 'Valgamaa', 
                                'Jõgevamaa'     => 'Jõgevamaa', 
                                'Pärnumaa'      => 'Pärnumaa', 
                                'Viljandimaa'   => 'Viljandimaa', 
                                'Järvamaa'      => 'Järvamaa', 
                                'Raplamaa'      => 'Raplamaa', 
                                'Võrumaa'       => 'Võrumaa', 
                            ), '1', array('id'=>'county')); }}
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="country">{{ Lang::get('text.country') }}</label>
                        {{ Form::text('country',  $post[0]->country, array('class'=>'form-control', 'placeholder'=>Lang::get('text.country'),'id'=>'country')) }}
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="postindex">{{ Lang::get('text.postindex') }}</label>
                        {{ Form::text('postindex',  $post[0]->postindex, array('class'=>'form-control', 'placeholder'=>Lang::get('text.postindex'),'id'=>'postindex')) }}
                    </div>
                </div>
            </div>
            
        </div>

    </div>

    {{ Form::submit(Lang::get('text.update'), array('class'=>'btn btn-large btn-primary'))}}
{{ Form::close() }}