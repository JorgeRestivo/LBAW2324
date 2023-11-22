@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="event-container">
            @foreach ($events as $event)
                <div class="event-box">
                    <div class="event-photo">
                        <img src="{{ asset('photos/' . $event->photo) }}" alt="Event Photo">
                    </div>
                    <div class="event-details">
                        <h2>{{ $event->eventname }}</h2>
                        <p>Start Date: {{ $event->startdatetime }}</p>
                        <p>End Date: {{ $event->enddatetime }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
