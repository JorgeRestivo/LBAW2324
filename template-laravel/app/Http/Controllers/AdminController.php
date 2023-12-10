<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class AdminController extends Controller
{
public function showNonAdminUsers()
{
    $nonAdminUsers = User::where('isadmin', false)->get();

    return view('nonAdminUsers', ['nonAdminUsers' => $nonAdminUsers]);
}
public function suspendUser($id)
{
    $user = User::find($id);

    if (!$user) {
        // Handle the case where the user is not found.
        abort(404);
    }

    // Update the user's status to "Suspended"
    DB::table('users')->updateOrInsert(
        ['id' => $user->id],
        ['userstatus' => 'Suspended']
    );

    return redirect()->route('admin.nonAdminUsers');
}
public function viewUserInfo($id)
{
    $user = User::find($id);

    if (!$user) {
        // Handle the case where the user is not found.
        abort(404);
        // ERROR
    }

    return view('viewUserInfo', ['user' => $user]);
}
public function manageEvents()
{
    // Fetch events ordered by end time
    $events = Event::orderBy('startdatetime', 'asc')->get();

    return view('manageEvents', ['events' => $events]);
}

public function viewEventInfo($id)
    {
        $event = Event::find($id);

        if (!$event) {
            abort(404); // Handle the case where the event with the given ID is not found.
        }

        return view('viewEventInfo', ['event' => $event]);
    }

// Add the method for deleting an event if you haven't already
public function deleteEvent($id)
{
    // Logic to delete the event with the given ID
    // ...

    // Redirect back with a success message
    return redirect()->back()->with('success', 'Event deleted successfully.');
}

}
