<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="msapplication-tap-highlight" content="no" />
    <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="{{ $metaDescription }}">
    <meta name="author" content="Servicefy OÜ">
    <meta name="keywords" content="{{ $metaKeywords }}" />
    <meta name="robots" content="noindex, nofollow">
    <!-- <link rel="icon" href=""> -->

    <title>{{ Lang::get('text.homepage_title') }}</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap-theme.min.css">

    {{-- HTML::style('assets/bootstrap/css/bootstrap.min.css') --}}
    {{-- HTML::style('assets/css/styles.css') --}}
    {{-- HTML::style('assets/css/smoothState/smoothState.css') --}}

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    {{ HTML::script('assets/lib/ie10-viewport-bug-workaround/ie10-viewport-bug-workaround.js') }}
    
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'xxxxxx', 'auto');
  ga('require', 'displayfeatures');
  ga('send', 'pageview');
</script>
  </head>

  <body>
    <header>
      <nav class="navbar navbar-default" role="navigation">
        <div class="container-fluid">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">vilaravel</a>
          </div>

          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
              @if ( Auth::guest() )
              <li class="active"><a href="/users/register">sign up</a></li>
              <li class=""><a href="/users/login">login</a></li>
              @else
              <li class=""><a href="/users/logout">log out</a></li>
              @endif
              <li><a href="/email/feedback">Send feedback</a></li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="/users/dashboard">dashboard</a></li>
                  <li><a href="#">Something else here</a></li>
                  <li class="divider"></li>
                  <li><a href="#">Separated link</a></li>
                  <li class="divider"></li>
                  <li><a href="#">One more separated link</a></li>
                </ul>
              </li>
            </ul>
            @if( Auth::guest() )
            {{ Form::open( array('url'=>'users/signin', 'role'=>'form', 'class'=>'navbar-form form-inline navbar-right') ) }}
              <div class="form-group">
                {{ Form::text('email', null, array('class'=>'form-control input-sm', 'placeholder'=>Lang::get('text.email'), 'id'=>'email' ) ) }}
              </div>
              <div class="form-group">
                {{ Form::password('password', null, array('class'=>'form-control input-sm', 'id'=>'password' ) ) }}
              </div>
              {{ Form::submit( Lang::get('text.login'), array('class'=>'btn btn-default btn-sm') ) }}
            {{ Form::close() }}
            @endif

            <ul class="nav navbar-nav navbar-right">
              <li><a href="#">Link</a></li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="#">Action</a></li>
                  <li><a href="#">Another action</a></li>
                  <li><a href="#">Something else here</a></li>
                  <li class="divider"></li>
                  <li><a href="#">Separated link</a></li>
                </ul>
              </li>
            </ul>
          </div><!-- /.navbar-collapse -->
        </div>
      </nav>
    </header>
    <div class="container">
    
      @if(Session::has('message'))
          <div class="alert alert-success pull-top full-wide text-center auto-close-alert">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{ Session::get('message') }}
          </div>
      @endif
      
      @if(Session::has('errormessage'))
          <div class="alert alert-danger text-center">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{ Session::get('errormessage') }}
          </div>
      @endif

      {{ $content }}
    
    </div>

    <footer>
      <div class="container-fluid">
        <div class="col-md-4">
          <p>Homepage</p>
        </div>
        <div class="col-md-4">
          <p class="pull-left">
            <script language="javascript">
              <!--
              var nic="info";
              var at="@";
              var dom="homepage.com"
              document.write("<a href=mailto:"+nic+at+dom+">"+nic+at+dom+"</a>");
              --> 
            </script>
          </p>
        </div>
        <div>
          <p class="pull-right"><a href="#tingimused" data-toggle="modal" data-target="#tingimused">Kasutaja tingimused</a></p>
        </div>
      </div>
    </footer>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <!-- --> 
    {{-- HTML::script('assets/jquery/jquery.min.js') --}}
    {{-- HTML::script('assets/jquery/jquery.smoothState.js') --}}
    {{-- HTML::script('assets/bootstrap/js/bootstrap.min.js') --}}
    {{-- HTML::script('assets/js/scripts.js') --}}
  </body>
</html>