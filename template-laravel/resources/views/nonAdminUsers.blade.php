<!-- resources/views/admin/nonAdminUsers.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Non-Admin Users</div>

                    <div class="card-body">
                        <p>List of Non-Admin Users:</p>

                        @if(count($nonAdminUsers) > 0)
                            <ul>
                                @foreach($nonAdminUsers as $user)
                                    <li>{{ $user->username }} ({{ $user->email }})</li>
                                @endforeach
                            </ul>
                        @else
                            <p>No non-admin users found.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
