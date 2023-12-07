<!-- resources/views/admin.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Admin Dashboard</div>

                    <div class="card-body">
                        <p>Welcome to the Admin Dashboard!</p>
                        
                        <!-- Button to go to Event Management Page -->
                        <a href="{{ route('admin.manageEvents') }}" class="btn btn-primary">Manage Events</a>

                        <!-- Add your admin-specific content here -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
