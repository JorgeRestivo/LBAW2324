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
                                @foreach($nonAdminUsers->sortBy('name') as $user)
                                    <li>
                                        {{ $user->name }} ({{ $user->email }})

                                        <form method="POST" action="{{ route('admin.updateUserStatus', ['id' => $user->id]) }}" style="display: inline;">
                                            @csrf
                                            @method('PUT')
                                            
                                            <input type="hidden" name="token" value="{{ uniqid() }}">
                                            
                                            <select name="userstatus">
                                                <option value="Active" {{ $user->userstatus == 'Active' ? 'selected' : '' }}>Active</option>
                                                <option value="Suspended" {{ $user->userstatus == 'Suspended' ? 'selected' : '' }}>Suspended</option>
                                                <option value="Banned" {{ $user->userstatus == 'Banned' ? 'selected' : '' }}>Banned</option>
                                            </select>

                                            <button type="submit" class="btn btn-primary btn-sm">Update Status</button>
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
