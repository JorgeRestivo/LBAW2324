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
use App\Models\Notification;



class EventsController extends Controller{
    public function getUserNotifications()
{
    $userId = auth()->id(); // Get the ID of the currently logged-in user
    $notifications = Notification::where('notified_user', $userId)->get();
    return response()->json($notifications);
}

}