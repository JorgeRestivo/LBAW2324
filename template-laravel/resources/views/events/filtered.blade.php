<!-- resources/views/events/filtered.blade.php -->

@extends('layouts.app')

@section('content')

<!-- Search Bar -->
<form action="{{ route('events.search') }}" method="GET">
    <input type="text" name="query" placeholder="Search Events">
    <button type="submit">Search</button>
</form>

<div class="filter-by-dropdown">
    <label for="tag-filter">Filter by:</label>
    <select id="tag-filter" class="tag-dropdown" onchange="filterByTag(this.value)">
        <option value="all">All Events</option>
        @foreach ($tags as $tag)
            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
        @endforeach
    </select>
</div>


    <div class="event-gallery">
        @if(isset($events) && count($events) > 0)
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
                            <div class="wishlist">
                                @if($event->inWishlist)
                                    <img src="{{ asset('photos/yellowstar.png') }}" alt="Event on Wishlist">
                                @else
                                    <img src="{{ asset('photos/whitestar.png') }}" alt="Add to Wishlist">
                                @endif
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        @else
            <p>No events found.</p>
        @endif
    </div>

    @if(isset($newEvent))
        <div class="alert alert-success">
            New Event Created: {{ $newEvent->eventname }}
            <!-- Display other information about the new event as needed -->
        </div>
    @endif

    <script>
    const filterByTagRoute = "{{ route('events.filterByTag') }}";
    </script>
    <script src="{{ asset('js/filterEvents.js') }}"></script>
@endsection
