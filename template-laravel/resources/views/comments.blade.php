<!-- resources/views/comments/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Comments</h2>

        @if(count($comments) > 0)
            <ul>
                @foreach($comments as $comment)
                    <div class="comment-box">
                        <p>Content: {{ $comment->content }}</p>
                        <p>Owner: {{ $comment->owner->name }}</p>
                        <p>Event: {{ $comment->event->eventname }}</p>
                        <p>Date and Time: {{ $comment->dateTime }}</p>
                    </div>
                @endforeach
            </ul>
        @else
            <p>No comments found.</p>
        @endif
    </div>
@endsection
