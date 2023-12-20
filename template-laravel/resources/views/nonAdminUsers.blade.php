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

                        <a href="{{ route('admin.manageEvents') }}" class="btn btn-primary btn-sm">Manage Events</a>

                        <p>List of Non-Admin Users:</p>

                        @if(count($nonAdminUsers) > 0)
                            <ul>
                                @foreach($nonAdminUsers->sortBy('username') as $user)
                                    <li>
                                        {{ $user->username }} ({{ $user->email }})
                                        <form method="POST" action="{{ route('admin.toggleUserStatus', ['id' => $user->id]) }}" style="display: inline;" onsubmit="return confirm('Are you sure you want to change the status of this user?');">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-{{ $user->userstatus == 'Suspended' ? 'success' : 'danger' }} btn-sm">
                                            {{ $user->userstatus == 'Suspended' ? 'Unsuspend User' : 'Suspend User' }}
                                            </button>
                                        </form>
                                        
                                        @if($user->userstatus == 'Banned')
                                            <form method="POST" action="{{ route('admin.toggleUserStatus', ['id' => $user->id]) }}" style="display: inline;" onsubmit="return confirm('Are you sure you want to ban this user?');">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    Unban User
                                                </button>
                                            </form> 
                                        @else
                                            <form method="POST" action="{{ route('admin.toggleUserStatus', ['id' => $user->id]) }}" style="display: inline;" onsubmit="return confirm('Are you sure you want to toggle the ban status of this user?');">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-warning btn-sm">
                                                    Ban User
                                                </button>
                                            </form>
                                        @endif
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

    <!-- JavaScript Timer for Flash Message -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            setTimeout(function () {
                var successMessage = document.getElementById('success-message');    
                if (successMessage) {
                    successMessage.style.display = 'none';
                }
            }, 5000); // Set the duration in milliseconds (e.g., 5000ms for 5 seconds)
        });
    </script>
@endsection
