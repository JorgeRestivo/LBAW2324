@extends('layouts.app')

@section('content')
<!-- Search Bar -->
<form action="{{ route('events.search') }}" method="GET" class="rounded-search-bar">
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
                        <p style="font-size: 17px; color: #ef9db2;">Start Date: {{ $event['startdatetime'] }}</p>
                        <h2 style="font-size: 25px; font-weight: bold; color: #7a7a7a;">{{ $event['eventname'] }}</h2>
                        <p2 style="font-size: 17px; color: #d3d3d3;">{{ $event['description'] }}</p2>
                    </div>
                </a>
                
                <div class="wishlist">
                    @if($event['inWishlist'])
                        <form action="{{ route('events.removeFromWishlist', ['eventId' => $event['id']]) }}" method="POST">
                            @csrf
                            <button type="submit" style="display: none;">
                                <img src="{{ asset('icons/bookmark.png') }}" alt="Event on Wishlist" style="width: 50px; height: 50px;">
                            </button>
                        </form>
                    @else
                        <form action="{{ route('events.addToWishlist', ['eventId' => $event['id']]) }}" method="POST">
                            @csrf
                            <button type="submit" style="display: none;">
                                <img src="{{ asset('icons/bookmark_cinzento.png') }}" alt="Add to Wishlist" style="width: 50px; height: 50px;">
                            </button>
                        </form>
                    @endif
                    <a href="#" onclick="event.preventDefault(); this.previousElementSibling.submit();">
                        @if($event['inWishlist'])
                            <img src="{{ asset('icons/bookmark.png') }}" alt="Event on Wishlist" style="width: 20px; height: 20px;">
                        @else
                            <img src="{{ asset('icons/bookmark_cinzento.png') }}" alt="Add to Wishlist" style="width: 20px; height: 20px;">
                        @endif
                    </a>
                </div>


            </div>
        @endforeach
    @else
        <p>No events found.</p>
    @endif

    @if(isset($newEvent))
        <div class="alert alert-success">
            New Event Created: {{ $newEvent['eventname'] }}
        </div>
    @endif
</div>

<script>
    const filterByTagRoute = "{{ route('events.filterByTag') }}";
</script>
<script src="{{ asset('js/filterEvents.js') }}"></script>
@endsection
