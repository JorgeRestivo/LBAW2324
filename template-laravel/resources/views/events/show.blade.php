<!-- resources/views/events/show.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="event-details-container">
        <div class="event-box">
            <div class="event-photo">
                <img src="{{ asset('photos/' . $event->photo) }}" alt="Event Photo">
            </div>
            <div class="event-details">
                <h2>{{ $event->eventname }}</h2>
                <p><strong>Start Date:</strong> {{ $event->startdatetime }}</p>
                <p><strong>End Date:</strong> {{ $event->enddatetime }}</p>
                <p><strong>Registration End Time:</strong> {{ $event->registrationendtime }}</p>
                <p><strong>Capacity:</strong> {{ $event->capacity }}</p>
                <p><strong>Location:</strong> {{ $event->local }}</p>
                <p><strong>Status:</strong> {{ $event->status }}</p>
                <p><strong>Description:</strong> {{ $event->description }}</p>
            </div>
        </div>

        <div class="comments-container">
            <h3>Comments</h3>
            
            @if(count($comments) > 0)
                <ul>
                    @foreach($comments as $comment)
                        <li>
                            <p>Content: {{ $comment->content }}</p>
                            <p>Owner: {{ $comment->owner->name }}</p>
                            <p>Date and Time: {{ $comment->dateTime }}</p>
                        </li>
                    @endforeach
                </ul>
            @else
                <p>No comments found.</p>
            @endif
        </div>



    </div>
@endsection
