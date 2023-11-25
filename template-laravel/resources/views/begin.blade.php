@extends('layouts.app')

@section('content')
    <div class="event-gallery">
        @foreach ($events as $event)
            <div class="event-box">
                <a href="{{ route('event.show', ['id' => $event->id]) }}">
                    <div class="event-photo">
                        <img src="{{ asset('photos/' . $event->photo) }}" alt="Event Photo">
                    </div>
                    <div class="event-details">
                        <h2>{{ $event->eventname }}</h2>
                        <p>Start Date: {{ $event->startdatetime }}</p>
                        <p>End Date: {{ $event->enddatetime }}</p>
                    </div>
                </a>
            </div>
        @endforeach

        @if(isset($newEvent))
            <div class="alert alert-success">
                New Event Created: {{ $newEvent->eventName }}
                <!-- Display other information about the new event as needed -->
            </div>
        @endif
    </div>
@endsection
