<!-- resources/views/events/search.blade.php -->

@extends('layouts.app')

@section('content')
    <h4>Search Results for "{{ $query }}"</h1>

    @if(count($events) > 0)
        <div class="event-container">
            @foreach ($events as $event)
                <div class="event-box">
                    <div class="event-photo">
                        <img src="{{ asset('photos/' . $event->photo) }}" alt="Event Photo">
                    </div>
                    <h2>{{ $event->eventname }}</h2>
                    <p>Start Date: {{ $event->startdatetime }}</p>
                    <p>End Date: {{ $event->enddatetime }}</p>
                    <!-- Adicione outros detalhes do evento conforme necessário -->
                </div>
            @endforeach
        </div>
    @else
        <p>No events found for the query "{{ $query }}"</p>
    @endif
@endsection
