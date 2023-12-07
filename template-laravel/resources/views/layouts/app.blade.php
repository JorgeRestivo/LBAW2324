<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ url('css/milligram.min.css') }}" rel="stylesheet">
    <link href="{{ url('css/app.css') }}" rel="stylesheet">
    <script type="text/javascript">
        // Fix for Firefox autofocus CSS bug
        // See: http://stackoverflow.com/questions/18943276/html-5-autofocus-messes-up-css-loading/18945951#18945951
    </script>
    <script type="text/javascript" src="{{ url('js/app.js') }}" defer></script>
</head>
<body>
    <main>
        <header>
            <h1><a href="{{ url('/events-begin') }}">GetTogether</a></h1>
            @if (Auth::check())
                <a href="{{ route('profile.show') }}">{{ Auth::user()->name }}</a>
                <a class="button" href="{{ url('/logout') }}">Logout</a>

                <!-- Search Bar -->
                <form action="{{ route('events.search') }}" method="GET">
                    <input type="text" name="query" placeholder="Search Events">
                    <button type="submit">Search</button>
                </form>

                <!-- Create Event Button -->
                <a href="{{ route('events.create') }}">Create Event</a>

                <!-- Create MyEvents Button -->
                <a href="{{ route('events.myevents') }}">My Events</a>

                <!-- Sent Invitations Button -->
                <a href="{{ route('sent_invitations.index') }}">Sent Invitations</a>

                <!-- Received Invitations Button -->
                <a href="{{ route('received_invitations.index') }}">Received Invitations</a>

                <!-- My schedule Button -->
                <a href="{{ route('events.going') }}">My Schedule</a>

                <!-- My Wishlist Button -->
                <a href="{{ route('events.wishlist') }}">My Wishlist</a>

                @if( Auth::user()->isadmin == 'true')
                    <a href="{{ route('admin.nonAdminUsers') }}">Go to Admin Page</a>
                @endif
                
                <a href="{{ route('about') }}">About</a>

                <a href="{{ route('faq') }}">FAQs</a>
            @endif
        </header>
        <section id="content">
            @yield('content')
        </section>
    </main>
</body>
</html>
