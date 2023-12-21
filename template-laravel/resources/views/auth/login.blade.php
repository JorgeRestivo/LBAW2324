@extends('layouts.minimal')

@section('content')

<link rel="icon" href="{{ asset('icons/shaking_hands.png') }}" type="image/png">

<div class="container">
    <!-- Adicione o script da API do Google -->
    <script src="https://apis.google.com/js/platform.js" async defer></script>

    <meta name="google-signin-client_id" content="gettogether@praxis-water-408115.iam.gserviceaccount.com">

    <p style="color: #f0ba4b; font-size: 35px; font-weight: bold; font-family: 'Gill Sans', sans-serif;">Log In</p>
    <div class="custom-message-container">
    <p style="color: #000; font-size: 17px; font-family: 'Gill Sans', sans-serif; margin-bottom:30px;">Hello! Enter your details to get sign in to your account.</p>
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
        <a class="button button-outline" href="{{ route('register') }}">Register</a>
        @if (session('success'))
            <p class="success">
                {{ session('success') }}
            </p>
        @endif
    </form>

    <p style="color: #000; font-size: 15px; font-family: 'Gill Sans', sans-serif;">--- Or sign in with ---</p>

    <!-- Botão de Login do Google -->
    <div class="g-signin2" data-onsuccess="onSignIn"></div>
    <p id='msg'></p>
    <!-- Adicione uma função JavaScript para lidar com o sucesso do login do Google -->
    <script>
    function onSignIn(googleUser) {
        // Aqui você pode implementar a lógica para lidar com o login bem-sucedido
        // Por exemplo, enviar dados para o servidor ou redirecionar o usuário.
        var profile = googleUser.getBasicProfile();
        var userID = profile.getId();
        var userName = profile.getName();
        var userPicture = profile.getImageUrl();
        var userEmail = profile.getEmail();
        var userToken = googleUser.getAuthResponse().id_token;

        document.getElementById('msg').innerHTML = userName;
        if(userEmail !== '') {
            var dados = {
                userID:userID,
                userName:userName,
                userPicture:userPicture,
                userEmail:userEmail,
                userToken:userToken
            };
            $.post('valida.blade.php',dados, function(retorna)) {
                if(retorna === '"error"') {
                    var msg = "User not found with this email";
                    document.getElementById('msg').innerHTML = retorna;
                } else {
                    window.location.href = retorna;
                }
            };
        } else {
            var msg = "User not found";
            document.getElementById('msg').innerHTML = msg;
        }
        /*console.log('ID: ' + profile.getId());
        console.log('Name: ' + profile.getName());
        console.log('Image URL: ' + profile.getImageUrl());
        console.log('Email: ' + profile.getEmail());*/
    }
</script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
</div>

@endsection
