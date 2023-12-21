@extends('layouts.app')

@section('content')
    <h2>{{ Auth::user()->name }}'s Profile</h2>
    <div class="profile-wrapper">
    <div class="profile-container">
        <img src="{{ asset(Auth::user()->profile_photo ?: 'profile_photos/user_profile.png') }}" class="rounded-profile">
        <h3>{{ Auth::user()->name }}</h3>
        <div class="text-secondary mb-2">
            <p><img src="icons/location.png" alt="Location Icon"> Porto, Portugal</p>
            <p><img src="icons/phone.png" alt="Phone Icon"> +(351) 123-4567</p>
        </div>

    </div>

    <div class="user-info">
    <div style="display: flex; align-items: center;">
        <h3 style="margin-right: 10px;">Account Details</h3>
        <a href="{{ route('profile.editProfileForm') }}" style="margin-left: auto;">
            <img src="icons/edit_profile.png" alt="Edit Profile Icon" class="edit-profile">
        </a>
    </div>
    <p><strong>Username:</strong> <strong class="info">{{ Auth::user()->username }}</strong></p>
    <p><strong>Name:</strong> <strong class="info">{{ Auth::user()->name }}</strong></p>
    <p><strong>Email:</strong> <strong class="info">{{ Auth::user()->email }}</strong></p>
</div>

</div>



    

@endsection
