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
            <h1>
                <a href="{{ url('/events-begin') }}">
                    <img src="{{ asset('photos/GetTogether.png') }}" alt="GetTogether Logo" style="width: 170px; height: auto;">
                </a>
            </h1>

            @if (Auth::check())
                <a href="{{ route('profile.show') }}">{{ Auth::user()->name }}</a>
                

                <!-- Navigation Links -->
                <nav>

                    <!-- Home Button -->
                    <a href="{{ url('/events-begin') }}">
                        @if(Request::is('events-begin'))
                        <img src="{{ asset('icons/icons8-casa-24.png') }}" alt="Ícone" style="width: 20px; height: auto;">
                        @else
                        <img src="{{ asset('icons/icons8-casa-24-2.png') }}" alt="Ícone" style="width: 20px; height: auto;">
                        @endif
                        Home
                    </a>

                    <!-- Create MyEvents Button -->
                    <a href="{{ route('events.myevents') }}">My Events</a>

                    <!-- Sent Invitations Button -->
                    <a href="{{ route('sent_invitations.index') }}">Sent Invitations</a>

                    <!-- Received Invitations Button -->
                    <a href="{{ route('received_invitations.index') }}">Received Invitations</a>

                    <!-- My schedule Button -->
                    <a href="{{ route('events.going') }}">My Schedule</a>

                    <!-- My Wishlist Button -->
                    <a href="{{ route('events.wishlist') }}">
                        @if(Request::is('events/wishlist'))
                        <img src="{{ asset('icons/bookmark.png') }}" alt="Ícone" style="width: 20px; height: auto;">
                        @else
                        <img src="{{ asset('icons/bookmark_cinzento.png') }}" alt="Ícone" style="width: 20px; height: auto;">
                        @endif
                        Wishlist
                    </a>

                    <!-- Create Event Button -->
                    <a href="{{ route('events.create') }}" class="create-event-button">Create Event</a>

                    @if( Auth::user()->isadmin == 'true')
                        <a href="{{ route('admin.nonAdminUsers') }}">Go to Admin Page</a>
                    @endif
                    
                    <a href="{{ route('about') }}">About</a>

                    <a href="{{ route('faq') }}">FAQs</a>

                </nav>
                <a class="button" href="{{ url('/logout') }}">Logout</a>
            @endif
        </header>
        <section id="content">
            @yield('content')
        </section>
    </main>
</body>
</html>
