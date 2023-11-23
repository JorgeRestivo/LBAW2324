@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Create a New Event</h2>
        <form action="{{ route('events.create') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="eventName">Event Name:</label>
                <input type="text" name="eventName" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="startDateTime">Start Date and Time:</label>
                <input type="datetime-local" name="startDateTime" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="endDateTime">End Date and Time:</label>
                <input type="datetime-local" name="endDateTime" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="registrationEndTime">Registration End Time:</label>
                <input type="datetime-local" name="registrationEndTime" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="local">Location:</label>
                <input type="text" name="local" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="description">Description:</label>
                <textarea name="description" class="form-control" required></textarea>
            </div>

            <div class="form-group">
                <label for="capacity">Capacity:</label>
                <input type="number" name="capacity" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="photo">Event Photo:</label>
                <input type="file" name="photo" class="form-control-file">
            </div>

            <button type="submit" class="button-primary">Create Event</button>
            <form action="{{ route('events.createEvent') }}" method="post" enctype="multipart/form-data">
        </form>
    </div>
@endsection
