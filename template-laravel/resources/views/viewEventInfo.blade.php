<!-- resources/views/admin/viewEventInfo.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Event Information</div>

                    <div class="card-body">
                        <h2>{{ $event->eventname }}</h2>
                        <p>Start Time: {{ $event->startdatetime }}</p>
                        <p>End Time: {{ $event->enddatetime }}</p>
                        <p>Location: {{ $event->local }}</p>
                        <p>Description: {{ $event->description }}</p>
                        <!-- Add more details as needed -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
