<!-- resources/views/events/going.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Events I'm Going</h2>

        @if(!empty($goingEvents) && count($goingEvents) > 0)
            <ul>
                @foreach($goingEvents as $event)
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
            </ul>
        @else
            <p>No events you're going to.</p>
        @endif

        <h2>Events I'm Not Going</h2>

        @if(!empty($notgoingEvents) && count($notgoingEvents) > 0)
            <ul>
                @foreach($notgoingEvents as $event)
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
            </ul>
        @else
            <p>No events you're not going to.</p>
        @endif

        <h2>Events I Maybe Going</h2>

        @if(!empty($maybegoingEvents) && count($maybegoingEvents) > 0)
            <ul>
                @foreach($maybegoingEvents as $event)
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
            </ul>
        @else
            <p>No events you're maybe going to.</p>
        @endif
    </div>
@endsection
