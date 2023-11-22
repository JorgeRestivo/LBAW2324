<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;

class EventsController extends Controller
{
    /**
     * Display the events.begin view.
     */
    public function begin()
    {
        return view('begin');
    }
}
