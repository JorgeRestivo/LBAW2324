<!-- resources/views/events/going.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>My Wishlist</h2>

        @if(!empty($wishlist) && count($wishlist) > 0)
            <ul>
                @foreach($wishlist as $event)
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
            <p>No events on your whishlist.</p>
        @endif

    </div>
@endsection
