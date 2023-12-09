<!-- resources/views/admin/manageEvents.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Event Management</div>

                    <div class="card-body">
                        <h2>All Events</h2>

                        @if(count($events) > 0)
                            <ul>
                                @foreach($events as $event)
                                    <li>
                                        <strong>{{ $event->eventname }}</strong> - Start Time: {{ $event->startdatetime }}
                                        <form method="POST" action="{{ route('admin.deleteEvent', ['id' => $event->id]) }}" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this event?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete Event</button>
                                        </form>

                                        <!-- Button to view event information -->
                                        <a href="{{ route('viewEventInfo', ['id' => $event->id]) }}" class="btn btn-info btn-sm">View Event Info</a>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p>No events found.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
