<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log; //debug

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Event; 

class EventsController extends Controller
{

    // EventsController.php

public function search(Request $request)
{
    $query = $request->input('query');
    $events = Event::where('eventname', 'like', '%' . $query . '%')->get();

    return view('index', ['events' => $events, 'query' => $query]);
}

    /**
     * Display the events.begin view.
     */
    public function showEvents()
    {
        $events = DB::table('events')->get()->toArray();
        return view('begin', ['events' => $events]);
    }
    public function createEvent(Request $request)
    {
        try {
            Log::info('createEvent method called');
    
            $request->validate([
                'eventName' => 'required|string|max:256',
                'startDateTime' => 'required|date',
                'endDateTime' => 'required|date|after:startDateTime',
                'registrationEndTime' => 'required|date|before:startDateTime',
                'local' => 'required|string|max:256',
                'description' => 'required|string|max:512',
                'capacity' => 'required|integer|min:1',
                'isPublic' => 'required|boolean',
                'status' => 'required|in:Active,Suspended,OtherStatus',
                'tag_id' => 'nullable|exists:tags,id',
                'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
    
            Log::info('Validation passed');
    
            $eventData = $request->all();
            $eventData['owner_id'] = Auth::id();
    
            if ($request->hasFile('photo')) {
                $photoPath = $request->file('photo')->store('event_photos', 'public');
                $eventData['photo'] = $photoPath;
            }
    
            $event = Event::create($eventData);
    
            Log::info('Event created successfully');
    
            return redirect()->route('events.begin')->withSuccess('Event created successfully!');
        } catch (\Exception $e) {
            Log::error('Error creating event: ' . $e->getMessage());
    
            return redirect()->back()->with('error', 'Error creating event. Please try again.');
        }
    }

    public function showCreateForm()
    {
        return view('formsevent'); // Assuming 'events.formsevent' is your new blade view
    }

}
