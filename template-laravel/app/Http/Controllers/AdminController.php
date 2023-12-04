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

}
