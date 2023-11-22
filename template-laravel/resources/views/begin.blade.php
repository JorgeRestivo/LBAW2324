<!-- resources/views/events.begin.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events List</title>
</head>
<body>
    <div style="text-align: center; padding: 50px;">
        <h1>Events List</h1>
        <ul>
            @foreach ($events as $event)
                <li>
                    <strong>{{ $event->eventName }}</strong><br>
                    Start Date: {{ $event->startDateTime }}<br>
                    End Date: {{ $event->endDateTime }}<br>
                </li>
            @endforeach
        </ul>
    </div>
</body>
</html>
