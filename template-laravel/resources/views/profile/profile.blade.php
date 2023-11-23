<!-- resources/views/profile/index.blade.php -->

@extends('layouts.app')

@section('content')
    <h2>Perfil de {{ Auth::user()->name }}</h2>
    <!-- Adicione mais informações do perfil conforme necessário -->
@endsection
