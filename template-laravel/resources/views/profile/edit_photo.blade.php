<!-- resources/views/profile/edit_photo.blade.php -->

@extends('layouts.app')

@section('content')
    <h2>Editar Foto do Perfil</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('profile.updatePhoto') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="profile_photo">Escolher Nova Foto do Perfil:</label>
            <input type="file" name="profile_photo" accept="image/*">

            <label for="username">Username:</label>
            <input type="text" id="username" name="username" value="{{ Auth::user()->username }}" required>

            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="{{ Auth::user()->name }}" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="{{ Auth::user()->email }}" required>
        </div>
        <button type="submit">Atualizar Perfil</button>
    </form>
@endsection
