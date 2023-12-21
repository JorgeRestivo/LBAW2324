<!-- resources/views/auth/login.blade.php -->

@extends('layouts.minimal')

@section('content')

<link rel="icon" href="{{ asset('icons/shaking_hands.png') }}" type="image/png">

<div class="header-container">
    <img src="{{ asset('photos/GetTogether.png') }}" alt="Logo" class="logo">
    <a class="button button-outline" style="color: #000; font-size: 17px; font-family: 'Gill Sans', sans-serif; margin-right:2%;" href="{{ route('register') }}">Register</a>
</div>

@if (session('success'))
    <p class="success">
        {{ session('success') }}
    </p>
@endif

<div class="container">
    <!-- Adicione o script da API do Google -->
    <script src="https://apis.google.com/js/platform.js" async defer></script>

    <meta name="google-signin-client_id" content="gettogether@praxis-water-408115.iam.gserviceaccount.com">

    <p style="color: #f0ba4b; font-size: 35px; font-weight: bold; font-family: 'Gill Sans', sans-serif;">Sign In</p>
    <div class="custom-message-container">
        <p style="color: #000; font-size: 17px; font-family: 'Gill Sans', sans-serif; margin-bottom:30px;">Hello! Enter your details to sign into your account.</p>
    </div>

    <form id="login-form"  method="POST" action="{{ route('login') }}">
        {{ csrf_field() }}

        <div class="custom-input-container">
            <label for="email">E-mail</label>
            <input id="email" class="custom-input" type="text" name="email" value="{{ old('email') }}" required autofocus>
            @if ($errors->has('email'))
                <span class="error">
                    {{ $errors->first('email') }}
                </span>
            @endif
        </div>

        <div class="custom-input-container">
            <label for="password">Password</label>
            <input id="password" class="custom-input" type="password" name="password" required>
            @if ($errors->has('password'))
                <span class="error">
                    {{ $errors->first('password') }}
                </span>
            @endif
        </div>

        <div class="remember-container">
            <label class="remember-label">
                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
            </label>
        </div>

        <div class="login-button-container">
            <button type="submit" class="login-button">
                Sign In
            </button>
        </div>
    </form>

    <div class="forgot-password-container">
        <a href="{{ route('password.reset') }}">Forgot My Password</a>
    </div>

    <p style="color: #000; font-size: 15px; font-family: 'Gill Sans', sans-serif;">--- Or sign in with ---</p>

    <div>
        <a style="background-color: skyblue; "href="{{url('auth/google')}}">
        Login using Google
        </a>
    </div>
</div>

@if (session('message'))
    <div class="alert alert-info">
        {{ session('message') }}
    </div>
@endif

@endsection
