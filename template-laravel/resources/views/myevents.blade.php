@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>My Events</h2>

        @if(count($myEvents) > 0)
            <ul>
                @foreach($myEvents as $event)
                    <div class="event-box">
                        <div class="event-photo">
                            <img src="{{ asset('photos/' . $event->photo) }}" alt="Event Photo">
                        </div>
                        <div class="event-details">
                            <h2>{{ $event->eventname }}</h2>
                            <p>Start Date: {{ $event->startdatetime }}</p>
                            <p>End Date: {{ $event->enddatetime }}</p>

                            <!-- Link to Event Details -->
                            <a href="{{ route('event.show', ['id' => $event->id]) }}">View Details</a>

                            <br>

                            <!-- Link to Invite Someone -->
                            <a href="{{ route('event.invite', ['eventId' => $event->id]) }}">Invite someone</a>

                            <br>
                        </div>
                    </div>

                    <!-- Display "Going" Attendees -->
                    <h3>Going Attendees:</h3>
                    @if(count($event->attendances) > 0)
                        <ul>
                            @foreach($event->attendances->where('participation', 'Going') as $attendance)
                                <li>
                                    {{ $attendance->user->name }} - {{ $attendance->participation }}
                                    <!-- Add a delete button/link here -->
                                    <a href="{{ route('remove.attendee', ['eventId' => $event->id, 'userId' => $attendance->user->id]) }}">Remove</a>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p>No "Going" attendees yet.</p>
                    @endif
                @endforeach
            </ul>
        @else
            <p>No events found.</p>
        @endif
    </div>
@endsection
