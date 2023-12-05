<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
    $user->update(['userStatus' => 'Suspended']);

    return redirect()->route('admin.nonAdminUsers');
}
public function viewUserInfo($id)
{
    $user = User::find($id);

    if (!$user) {
        // Handle the case where the user is not found.
        abort(404);
    }

    return view('viewUserInfo', ['user' => $user]);
}

}
