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
        </div>
        <button type="submit">Atualizar Foto do Perfil</button>
    </form>
@endsection
