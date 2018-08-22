@extends('layouts.template')

@section('content-form')

<form class="login form" role="form" method="POST" action="{{ url('/login') }}">
    {{ csrf_field() }}

    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Login">

        @if ($errors->has('email'))
        <span class="help-block">
            <strong>{{ $errors->first('email') }}</strong>
        </span>
        @endif
    </div>

    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">

        <input id="password" type="password" class="form-control" name="password" placeholder="Senha">

        @if ($errors->has('password'))
        <span class="help-block">
            <strong>{{ $errors->first('password') }}</strong>
        </span>
        @endif
    </div>


    <div class="form-group">
        <button type="submit" class="btn btn-login">
            <i class="fa fa-btn fa-sign-in"></i> Login
        </button>
    </div>
    <div class='form-group'>
        <a href='{{route('register')}}' class='btn btn-login' 
           role='button'><span class="glyphicon glyphicon-user"></span> Registrar </a>
    </div>

    <div class="form-group text-right">
        <a class="recuperar" href="{{ url('/password/reset') }}">Recuperar Senha?</a>
    </div>
</form>

@endsection