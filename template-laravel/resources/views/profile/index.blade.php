@extends('layouts.app')

@section('content')
    <h2>{{ Auth::user()->name }}'s Profile</h2>
    <div class="profile-container">
        <img src="{{ asset(Auth::user()->profile_photo ?: 'profile_photos/user_profile.png') }}" class="rounded-profile">
        <div class="user-info">
            <p><strong>Username:</strong> {{ Auth::user()->username }}</p>
            <p><strong>Name:</strong> {{ Auth::user()->name }}</p>
            <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
        </div>
    </div>
    <div>
        <a href="{{ route('profile.editProfileForm') }}">Editar Perfil</a>
    </div>
@endsection
