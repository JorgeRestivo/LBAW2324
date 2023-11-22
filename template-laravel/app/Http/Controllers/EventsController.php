<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventsController extends Controller
{
    /**
     * Display the events.begin view.
     */
    public function showEvents()
    {
        $events = DB::table('events')->get()->toArray();
        return view('begin', ['events' => $events]);
    }
}
