@extends('layouts.app')

@section('content')

<!-- Adicione o script da API do Google -->
<script src="https://apis.google.com/js/platform.js" async defer></script>

<meta name="google-signin-client_id" content="gettogether@praxis-water-408115.iam.gserviceaccount.com">

<form method="POST" action="{{ route('login') }}">
    {{ csrf_field() }}

    <label for="email">E-mail</label>
    <input id="email" type="text" name="email" value="{{ old('email') }}" required autofocus>
    @if ($errors->has('email'))
        <span class="error">
          {{ $errors->first('email') }}
        </span>
    @endif

    <label for="password" >Password</label>
    <input id="password" type="password" name="password" required>
    @if ($errors->has('password'))
        <span class="error">
            {{ $errors->first('password') }}
        </span>
    @endif

    <label>
        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
    </label>

    <button type="submit">
        Login
    </button>
    <a class="button button-outline" href="{{ route('register') }}">Register</a>
    @if (session('success'))
        <p class="success">
            {{ session('success') }}
        </p>
    @endif


</form>

<!-- Botão de Login do Google -->
<div class="g-signin2" data-onsuccess="onSignIn"></div>
<p id = 'msg'></p>
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

@endsection