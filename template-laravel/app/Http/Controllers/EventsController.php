<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log; //debug

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\Invitation;
use App\Models\Comment;
use App\Models\Event;
use App\Models\User;
use App\Models\Attendance;
use App\Models\Tag;


class EventsController extends Controller
{

    public function search(Request $request)
    {
        $query = $request->input('query');

        $events = Event::where('eventname', 'like', '%' . $query . '%')->get();

        return view('events.search', ['events' => $events, 'query' => $query]);
    }

    
    public function showEvents(){
        $tags = Tag::all();

    // Get all public events
    $publicEvents = Event::where('ispublic', true)->get()->toArray();

    // Get private events user was invited to
    $userId = auth()->id();
    $privateEvents = Event::whereIn(
        'id',
        function ($query) use ($userId) {
            $query->select('event_id')
                ->from('eventinvitation') // Adjust the case here
                ->where('user_invited_id', $userId);
        }
    )->where('ispublic', false)->get()->toArray();

    // Merge public and private events
    $events = array_merge($publicEvents, $privateEvents);

    // Add an 'inWishlist' property to each event
    $wishlist = $this->checkWishlist();
    foreach ($events as &$event) {
        $event['inWishlist'] = in_array($event['id'], $wishlist);
    }

    return view('begin', ['events' => $events, 'wishlist' => $wishlist, 'tags' => $tags]);
}


    public function createEvent(Request $request) {
        try {
            Log::info('createEvent method called');
    
            $request->validate([
                'eventname' => 'required|string|max:256',
                'startdatetime' => 'required|date',
                'enddatetime' => 'required|date|after:startDateTime',
                'registrationendtime' => 'required|date',
                'local' => 'required|string|max:256',
                'description' => 'required|string|max:512',
                'capacity' => 'required|integer|min:1',
                'isPublic' => 'boolean',
                'status' => 'in:Active,Suspended,OtherStatus',
                'tag_id' => 'nullable|exists:tags,id',
                'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
    
    
            $ownerId = auth()->id();

            $eventData = $request->all();
            $eventData['owner_id'] = $ownerId;

            $eventData['isPublic'] = $request->has('isPublic') ? $request->input('isPublic') : true;
            $eventData['status'] = $request->input('status', 'Active');
    
            if ($request->hasFile('photo')) {
                $photoPath = $request->file('photo')->store('event_photos', 'public');
                $eventData['photo'] = $photoPath;
            }
    
            $event = Event::create($eventData);
    

            $events = Event::all();

            return view('begin', ['events' => $events]);

        } catch (\Exception $e) {
            Log::error('Error creating event: ' . $e->getMessage());
    
            return redirect()->back()->with('error', 'Error creating event. Please try again.');
        }
    }


    public function showCreateForm() {
        return view('formsevent');
    }


    public function show($id) {
        $event = Event::find($id);

        if (!$event) {
            // Handle the case where the event with the given ID is not found.
            abort(404);
        }

        $comments = Comment::where('event_id', $event->id)->get();

        return view('events.show', ['event' => $event, 'comments' => $comments]);
    }

    public function showMyEvents()
{
    $ownerId = auth()->id();

    $myEvents = Event::where('owner_id', $ownerId)->with('attendances.user')->get();

    return view('myevents', ['myEvents' => $myEvents]);
}



    public function sendInvitation(Request $request, $eventId)
    {

        $request->validate([
            'inviteeId' => 'required|exists:users,id',
        ]);

        $event = Event::find($eventId);

        // usar para as notificações
        //$event->invitedUsers()->attach($request->input('inviteeId'));

        return redirect()->route('event.show', ['id' => $eventId])->with('success', 'Invitation sent successfully!');
    }

    public function showInviteForm($eventId)
    {
        $users = User::all();
        $event = Event::find($eventId);

        return view('form', ['users' => $users, 'event' => $event]);
    }

    public function showSentInvitations()
    {
        $userId = Auth::id();
        $sentInvitations = Invitation::where('user_host_id', $userId)->get();

        return view('sent_invitations', ['sentInvitations' => $sentInvitations]);
    }

    public function showReceivedInvitations()
    {
        $userId = Auth::id();
        $receivedInvitations = Invitation::where('user_invited_id', $userId)->get();

        return view('received_invitations', ['receivedInvitations' => $receivedInvitations]);
    }

    public function showEventsImGoing()
    {
        $userId = Auth::id();

        $goingEvents = DB::table('attendance')
            ->join('events', 'attendance.event_id', '=', 'events.id')
            ->where('attendance.user_id', '=', $userId)
            ->where('attendance.participation', '=', 'Going')
            ->select('events.*','attendance.participation')
            ->get();
        
        $notgoingEvents = DB::table('attendance')
            ->join('events', 'attendance.event_id', '=', 'events.id')
            ->where('attendance.user_id', '=', $userId)
            ->where('attendance.participation', '=', 'Not Going')
            ->select('events.*')
            ->get();

        $maybegoingEvents = DB::table('attendance')
            ->join('events', 'attendance.event_id', '=', 'events.id')
            ->where('attendance.user_id', '=', $userId)
            ->where('attendance.participation', '=', 'Maybe')
            ->select('events.*')
            ->get();

        return view('events.going', ['goingEvents' => $goingEvents, 'notgoingEvents' => $notgoingEvents, 'maybegoingEvents' => $maybegoingEvents]);
    }


    public function showWishlist()
    {
        $userId = Auth::id();
        
        $wishlist = DB::table('attendance')
            ->join('events', 'attendance.event_id', '=', 'events.id')
            ->where('attendance.user_id', '=', $userId)
            ->where('attendance.wishlist', '=', true)
            ->select('events.*')
            ->get();

        return view('events.wishlist', ['wishlist' => $wishlist]);
    }

    public function checkWishlist(){
    $userId = Auth::id();
    
    $wishlistEvents = DB::table('attendance')
        ->join('events', 'attendance.event_id', '=', 'events.id')
        ->where('attendance.user_id', '=', $userId)
        ->where('attendance.wishlist', '=', true)
        ->pluck('events.id')
        ->toArray();

    return $wishlistEvents;
}

public function addToWishlist($eventId)
{
    $userId = auth()->id();

    // Check if the user has attended the event
    $attended = DB::table('attendance')
        ->where('user_id', $userId)
        ->where('event_id', $eventId)
        ->exists();

    // Add the event to the wishlist, regardless of attendance
    DB::table('attendance')->updateOrInsert(
        ['user_id' => $userId, 'event_id' => $eventId],
        ['wishlist' => true]
    );

    return redirect()->back()->with('success', 'Event added to wishlist successfully.');
}





public function changeDecision(Request $request, $id)
{
    // Add a debug statement for entering the method
    Log::debug("Entering changeDecision method. Event ID: $id");

    try {
        // Validate the form data
        $request->validate([
            'decision' => 'required|in:Going,Maybe,Not Going',
        ]);

        // Find the Attendance record by event ID and user ID
        $userId = Auth::id();

        // Update the decision
        Attendance::where('user_id', $userId)
            ->where('event_id', $id)
            ->update([
                'participation' => $request->input('decision'),
            ]);

        // Add a debug statement for successful update
        Log::debug("Decision updated successfully.");

        return redirect()->back()->with('success', 'Decision updated successfully.');
    } catch (\Exception $e) {
        // Add a debug statement for catching exceptions
        Log::error("Error in changeDecision method: " . $e->getMessage());

        // Handle the exception (e.g., return an error response)
        return redirect()->back()->with('error', 'Error updating decision.');
    } finally {
        // Add a debug statement for exiting the method (whether successful or with an error)
        Log::debug("Exiting changeDecision method");
    }
}

public function removeAttendee($eventId, $userId)
    {
        try {
            // Find the attendance record and update the participation status to 'Not Going'
            Attendance::where('event_id', $eventId)
                ->where('user_id', $userId)
                ->update(['participation' => 'Not Going']);

            return redirect()->back()->with('success', 'Attendee removed successfully.');
        } catch (\Exception $e) {
            // Handle the exception (e.g., return an error response)
            return redirect()->back()->with('error', 'Error removing attendee.');
        }
    }

    public function filterByTag(Request $request)
    {
        $tags = Tag::all();
        $tagId = $request->query('tag');

        if ($tagId) {
            // Retrieve events associated with the specified tag
            $events = Event::where('tag_id', $tagId)->get();
        } else {
            // If no tag is specified, retrieve all events
            $events = Event::all();
        }

        // ... pass $events and other necessary data to the view ...

        return view('events.filtered', compact('events'), ['tags' => $tags]);
    }

}


