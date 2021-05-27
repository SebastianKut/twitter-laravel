<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    public function store(User $user)
    {
        auth()->user()->toggleFollow($user);

        return back()->with('message', (auth()->user()->isFollowing($user) ? "You followed "  : "You unfollowed ") . $user->name);
    }
}
