@extends('layouts.app')

@section('content')
<!-- Search Bar -->
<form action="{{ route('events.search') }}" method="GET" class="rounded-search-bar">
    <input type="text" name="query" placeholder="Search Events">
    <button type="submit">Search</button>
    <div class="notification-container">
        <img src="{{ asset('icons/notifications.png') }}" alt="Notifications" class="notification-bell">
        <div class="notification-dropdown">
            <!-- Notification items will be appended here dynamically using JavaScript -->
        </div>
    </div>
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
                                <img src="{{ asset('icons/bookmark.png') }}" alt="Event on Wishlist" style="width: 40px; height: 40px;">
                            </button>
                        </form>
                    @else
                        <form action="{{ route('events.addToWishlist', ['eventId' => $event['id']]) }}" method="POST">
                            @csrf
                            <button type="submit" style="display: none;">
                                <img src="{{ asset('icons/bookmark_cinzento.png') }}" alt="Add to Wishlist" style="width: 40px; height: 40px;">
                            </button>
                        </form>
                    @endif
                    <a href="#" onclick="event.preventDefault(); this.previousElementSibling.submit();">
                        @if($event['inWishlist'])
                            <img src="{{ asset('icons/bookmark.png') }}" alt="Event on Wishlist" style="width: 40px; height: 40px;">
                        @else
                            <img src="{{ asset('icons/bookmark_cinzento.png') }}" alt="Add to Wishlist" style="width: 40px; height: 40px;">
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
    document.addEventListener("DOMContentLoaded", function () {
    const bellIcon = document.querySelector(".notification-bell");
    const notificationDropdown = document.querySelector(".notification-dropdown");
    let isDropdownVisible = false;

    bellIcon.addEventListener("click", function (event) {
        isDropdownVisible = !isDropdownVisible;
        notificationDropdown.classList.toggle("show", isDropdownVisible);

        if (isDropdownVisible) {
            // Load and display notifications only when opening the dropdown
            const placeholderNotifications = [
                { message: 'Notification 1' },
                { message: 'Notification 2' },
                { message: 'Notification 3' },
            ];
            updateNotificationDropdown(placeholderNotifications);
        }

        event.stopPropagation();
    });

    // Close the dropdown if the user clicks outside of it
    document.addEventListener("click", function () {
        if (isDropdownVisible) {
            notificationDropdown.classList.remove("show");
            isDropdownVisible = false;
        }
    });

    function updateNotificationDropdown(notifications) {
        notificationDropdown.innerHTML = '';
        notifications.forEach(notification => {
            const notificationItem = document.createElement('div');
            notificationItem.textContent = notification.message;
            notificationDropdown.appendChild(notificationItem);
        });
    }
});



</script>



<script src="{{ asset('js/filterEvents.js') }}"></script>
@endsection
