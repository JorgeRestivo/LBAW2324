@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>My Events</h2>

        @if(count($myEvents) > 0)
            <ul>
                @foreach($myEvents as $event)
                    <li>{{ $event->eventname }} - {{ $event->startdatetime }}</li>
                    <!-- Add more details as needed -->
                @endforeach
            </ul>
        @else
            <p>No events found.</p>
        @endif
    </div>
@endsection
