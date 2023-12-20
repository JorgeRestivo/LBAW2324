<!-- resources/views/admin/nonAdminUsers.blade.php -->

@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/table.css') }}">
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

                        <!-- ... (previous code) ... -->

                        <table>
                            <thead>
                                <tr>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>User Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody> 
                                @foreach($nonAdminUsers->sortBy('username') as $user)
                                    <tr>
                                        <td>{{ htmlspecialchars($user->username) }}</td>
                                        <td>{{ htmlspecialchars($user->email) }}</td>
                                        <td>
                                            <form method="POST" action="{{ route('admin.updateUserStatus', ['id' => $user->id]) }}" style="display: inline; margin: 0;">
                                                @csrf
                                                @method('PUT')

                                                <input type="hidden" name="token" value="{{ uniqid() }}">

                                                <select name="userstatus" style="width: 120px; padding: 2px;">
                                                    <option value="Active" {{ $user->userstatus == 'Active' ? 'selected' : '' }}>Active</option>
                                                    <option value="Suspended" {{ $user->userstatus == 'Suspended' ? 'selected' : '' }}>Suspended</option>
                                                    <option value="Banned" {{ $user->userstatus == 'Banned' ? 'selected' : '' }}>Banned</option>
                                                </select>

                                                <button type="submit" class="btn btn-primary btn-sm" style="padding: 2px;">Update</button>
                                            </form>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.viewUserInfo', ['id' => $user->id]) }}" class="btn btn-info btn-sm">View Info</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <!-- ... (remaining code) ... -->

                        @if(count($nonAdminUsers) == 0)
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
