@extends('layouts.app')

@section('content')
    <h2>Perfil de {{ Auth::user()->name }}</h2>
    <img src="{{ asset('profile_photos/' . Auth::user()->profile_photo) }}" alt="Profile Photo">
    <!-- Adicione mais informações do perfil conforme necessário -->
@endsection