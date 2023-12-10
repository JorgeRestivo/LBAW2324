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

                

                <!-- Navigation Links -->
                <nav>

                <!-- Home Button -->
                <span class="home_button @if(Request::is('events-begin')) active @endif">
                    <a href="{{ url('/events-begin') }}">
                        @if(Request::is('events-begin'))
                        <img src="{{ asset('icons/icons8-casa-24.png') }}" alt="Ícone" style="width: 20px; height: auto;">
                        @else
                        <img src="{{ asset('icons/icons8-casa-24-2.png') }}" alt="Ícone" style="width: 20px; height: auto;">
                        @endif
                        Home
                    </a>
                </span>

                    <!-- Create MyEvents Button -->
                    <a href="{{ route('events.myevents') }}">My Events</a>

                    <!-- Sent Invitations Button -->
                    <a href="{{ route('sent_invitations.index') }}">Sent Invitations</a>

                    <!-- Received Invitations Button -->
                    <a href="{{ route('received_invitations.index') }}">Received Invitations</a>

                    <!-- My schedule Button -->
                    <a href="{{ route('events.going') }}">My Schedule</a>

                    <!-- Wishlist Button -->
                    <span class="wishlist_button @if(Request::is('events/wishlist')) active @endif">
                        <a href="{{ route('events.wishlist') }}">
                            @if(Request::is('events/wishlist'))
                            <img src="{{ asset('icons/bookmark.png') }}" alt="Ícone" style="width: 20px; height: auto;">
                            @else
                            <img src="{{ asset('icons/bookmark_cinzento.png') }}" alt="Ícone" style="width: 20px; height: auto;">
                            @endif
                            Wishlist
                        </a>
                    </span>


                    <!-- Create Event Button -->
                    <a href="{{ route('events.create') }}" class="create-event-button">Create Event</a>

                    @if( Auth::user()->isadmin == 'true')
                        <a href="{{ route('admin.nonAdminUsers') }}">Go to Admin Page</a>
                    @endif
                    
                    <a href="{{ route('about') }}">About</a>

                    <a href="{{ route('faq') }}">FAQs</a>

                </nav>
                <a class="button" href="{{ url('/logout') }}">Logout</a>


                <span class="username">
                <img src = "{{asset('profile_photos/user_profile.png')}}" alt="Ícone" class="profile-icon">
                <a href="{{ route('profile.show') }}">{{ Auth::user()->name }}</a>
                </span>
            @endif
        </header>
        <section id="content">
            @yield('content')
        </section>
    </main>
</body>
</html>
