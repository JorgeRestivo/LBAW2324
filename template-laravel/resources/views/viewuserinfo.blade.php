<!-- resources/views/admin/viewUserInfo.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">User Information</div>

                    <div class="card-body">
                        <p>User Name: {{ $user->name }}</p>
                        <p>Email: {{ $user->email }}</p>
                        <!-- Add other user information as needed -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
