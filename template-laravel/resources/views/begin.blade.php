@extends('layouts.app')

@section('content')
<!-- Search Bar -->
<form action="{{ route('events.search') }}" method="GET">
    <input type="text" name="query" placeholder="Search Events">
    <button type="submit">Search</button>
</form>

<div class="tag-buttons">
    @foreach ($tags as $tag)
        <button onclick="filterByTag({{ $tag->id }})">{{ $tag->name }}</button>
    @endforeach
</div>
<div class="event-gallery">
    @if(isset($events) && count($events) > 0)
        @foreach ($events as $event)
            <div class="event-box">
                <a href="{{ route('event.show', ['id' => $event['id']]) }}">
                    <div class="event-photo">
                        <img src="{{ asset('photos/' . $event['photo']) }}" alt="Event Photo">
                    </div>
                    <div class="event-details">
                        <h2>{{ $event['eventname'] }}</h2>
                        <p>Start Date: {{ $event['startdatetime'] }}</p>
                        <p>End Date: {{ $event['enddatetime'] }}</p>
                    </div>
                </a>
                
                <div class="wishlist">
                            @if($event['inWishlist'])
                            <form action="{{ route('events.removeFromWishlist', ['eventId' => $event['id']]) }}" method="POST">
                            @csrf
                            <button type="submit">
                                <img src="{{ asset('photos/yellowstar.png') }}" alt="Event on Wishlist">
                            </button>
                            </form>
                            @else
                            <form action="{{ route('events.addToWishlist', ['eventId' => $event['id']]) }}" method="POST">
                            @csrf
                            <button type="submit">
                                <img src="{{ asset('photos/whitestar.png') }}" alt="Add to Wishlist">
                            </button>
                            </form>

                            @endif
                    
                </div>
            </div>
        @endforeach
    @else
        <p>No events found.</p>
    @endif

    @if(isset($newEvent))
        <div class="alert alert-success">
            New Event Created: {{ $newEvent['eventname'] }}
            <!-- Display other information about the new event as needed -->
        </div>
    @endif
</div>

<script>
    const filterByTagRoute = "{{ route('events.filterByTag') }}";
</script>
<script src="{{ asset('js/filterEvents.js') }}"></script>
@endsection
