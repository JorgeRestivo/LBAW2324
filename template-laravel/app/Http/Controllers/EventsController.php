<?php

namespace App\Http\Controllers;

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
}
