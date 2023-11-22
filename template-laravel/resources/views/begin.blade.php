@extends('layouts.app')

@section('content')
    <div class="event-container">
        @foreach ($events as $event)
            <div class="event-box">
                <h2>{{ $event->eventname }}</h2>
                <p>Start Date: {{ $event->startdatetime }}</p>
                <p>End Date: {{ $event->enddatetime }}</p>
            </div>
        @endforeach
    </div>
@endsection

@section('styles')
    <style>
        .event-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }

        .event-box {
            background-color: red;
            color: white;
            padding: 10px;
            margin: 10px;
            width: 200px;
            text-align: center;
        }
    </style>
@endsection
