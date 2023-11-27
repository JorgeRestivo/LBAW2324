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

class EventsController extends Controller
{

    public function search(Request $request)
    {
        $query = $request->input('query');

        $events = Event::where('eventname', 'like', '%' . $query . '%')->get();

        return view('events.search', ['events' => $events, 'query' => $query]);
    }

    
    public function showEvents() {
        $events = DB::table('events')->get()->toArray();
        return view('begin', ['events' => $events]);
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

    public function showMyEvents(){
        $ownerId = auth()->id();

        $myEvents = Event::where('owner_id', $ownerId)->get();

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
            ->select('events.*')
            ->get();
        
        $notgoingEvents = DB::table('attendance')
            ->join('events', 'attendance.event_id', '=', 'events.id')
            ->where('attendance.user_id', '=', $userId)
            ->where('attendance.participation', '=', 'Not Going')
            ->select('events.*')
            ->get();

        return view('events.going', ['goingEvents' => $goingEvents, 'notgoingEvents' => $notgoingEvents]);
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

}


