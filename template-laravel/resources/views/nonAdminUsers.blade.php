<!-- resources/views/admin/nonAdminUsers.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Non-Admin Users</div>

                    <div class="card-body">
                        @if(session('success'))
                            <div id="success-message" class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        <p>List of Non-Admin Users:</p>

                        @if(count($nonAdminUsers) > 0)
                            <ul>
                                @foreach($nonAdminUsers as $user)
                                    <li>
                                        {{ $user->name }} ({{ $user->email }})
                                        <form method="POST" action="{{ route('admin.suspendUser', ['id' => $user->id]) }}" style="display: inline;">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-danger btn-sm">Suspend User</button>
                                        </form>
                                        <a href="{{ route('admin.viewUserInfo', ['id' => $user->id]) }}" class="btn btn-info btn-sm">View User Info</a>
                                    </li>
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