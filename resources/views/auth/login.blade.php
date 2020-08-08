<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ config('app.name', 'Minutes of Meeting') }}</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
	<script src="{{ asset('js/jquery.cookie.js') }}"></script>
	<script src="{{ asset('js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
	<script src="{{ asset('js/metisMenu.min.js') }}"></script>
	<script src="{{ asset('js/sb-admin-2.js')}}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css">

    <!-- Styles -->
    {{--  <link href="{{ asset('css/app.css') }}" rel="stylesheet">  --}}
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet"/>
	<link href="{{ asset('css/bootstrap-datepicker.min.css') }}" rel="stylesheet"/>
	<link href="{{ asset('css/metisMenu.min.css') }}" rel="stylesheet"/>
	<link href="{{ asset('css/sb-admin-2.css') }}" rel="stylesheet"/>
	<link href="{{ asset('css/faza.css') }}" rel="stylesheet"/>
	<link rel="shortcut icon" href="{{ asset('img/favicon.ico')}}" type="image/x-icon"/>
</head>
<body>
    <div id="app">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="login-panel panel panel-default">
                        <div class="panel-heading" style="text-align:center;">
                            <h1 class="panel-title"><img class="logo" src="{{ asset('img/logo.png') }}"/></h1>
                        </div>
                        <div class="panel-body">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="form-group">
                                    <input class="form-control" placeholder="Email" id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                                    
                                </div>
                                <div class="form-group">
                                    <input id="password" placeholder="Password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                                    
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6 offset-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="remember">
                                                    {{ __('Remember Me') }}
                                                </label>
                                        </div>
                                    </div>
                                </div>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <div class="alert alert-danger">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </div>
                                    </span>
                                @endif
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <div class="alert alert-danger">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </div>
                                    </span>
                                @endif
                                <button type="submit" class="btn btn-lg btn-primary btn-block">
                                    {{ __('Login') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>