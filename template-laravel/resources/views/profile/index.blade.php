@extends('layouts.app')

@section('content')
    <h2>Perfil de {{ Auth::user()->name }}</h2>
    <div class="profile-container">
        <img src="{{ asset('profile_photos/' . Auth::user()->profile_photo) }}" alt="Profile Photo">
        <div class="user-info">
            <p><strong>Username:</strong> {{ Auth::user()->username }}</p>
            <p><strong>Name:</strong> {{ Auth::user()->name }}</p>
            <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
        </div>
    </div>
        <!-- Adicione mais informações do perfil conforme necessário -->
    <div>
        <a href="{{ route('profile.editPhotoForm') }}">Editar Perfil</a>
    </div>
@endsection