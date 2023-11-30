<!-- resources/views/events/going.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Events I'm Going</h2>

        @if(!empty($goingEvents) && count($goingEvents) > 0)
            <ul>
                @foreach($goingEvents as $attendance)
                    <div class="event-box">
                        <a href="{{ route('event.show', ['id' => $attendance->id]) }}">
                            <div class="event-photo">
                                <img src="{{ asset('photos/' . $attendance->photo) }}" alt="Event Photo">
                            </div>
                            <div class="event-details">
                                <h2>{{ $attendance->eventname }}</h2>
                                <p>Start Date: {{ $attendance->startdatetime }}</p>
                                <p>End Date: {{ $attendance->enddatetime }}</p>

                                <!-- Form to change "my decision" for events I'm going -->
                                <form action="{{ route('event.changeDecision', ['id' => $attendance->id]) }}" method="POST">

                                    @csrf
                                    @method('PUT')

                                    <label for="decision">My Decision:</label>
                                    <select name="decision" id="decision">
                                        <option value="Going" {{ $attendance->participation === 'Going' ? 'selected' : '' }}>Going</option>
                                        <option value="Maybe" {{ $attendance->participation === 'Maybe' ? 'selected' : '' }}>Maybe</option>
                                        <option value="Not Going" {{ $attendance->participation === 'Not Going' ? 'selected' : '' }}>Not Going</option>
                                    </select>

                                    <button type="submit">Update Decision</button>
                                </form>
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
                @foreach($notgoingEvents as $attendance)
                    <div class="event-box">
                        <a href="{{ route('event.show', ['id' => $attendance->id]) }}">
                            <div class="event-photo">
                                <img src="{{ asset('photos/' . $attendance->photo) }}" alt="Event Photo">
                            </div>
                            <div class="event-details">
                                <h2>{{ $attendance->eventname }}</h2>
                                <p>Start Date: {{ $attendance->startdatetime }}</p>
                                <p>End Date: {{ $attendance->enddatetime }}</p>

                                
                            </div>
                        </a>
                    </div>
                @endforeach
            </ul>
        @else
            <p>No events you're not going to.</p>
        @endif

        <h2>Events I May Be Going</h2>

        @if(!empty($maybegoingEvents) && count($maybegoingEvents) > 0)
            <ul>
                @foreach($maybegoingEvents as $attendance)
                    <div class="event-box">
                        <a href="{{ route('event.show', ['id' => $attendance->id]) }}">
                            <div class="event-photo">
                                <img src="{{ asset('photos/' . $attendance->photo) }}" alt="Event Photo">
                            </div>
                            <div class="event-details">
                                <h2>{{ $attendance->eventname }}</h2>
                                <p>Start Date: {{ $attendance->startdatetime }}</p>
                                <p>End Date: {{ $attendance->enddatetime }}</p>

                            </div>
                        </a>
                    </div>
                @endforeach
            </ul>
        @else
            <p>No events you may be going to.</p>
        @endif
    </div>
@endsection
