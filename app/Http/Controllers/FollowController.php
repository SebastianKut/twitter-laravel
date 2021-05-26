<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    public function store(User $user)
    {
        auth()->user()->toggleFollow($user);

        $following = auth()->user()->isFollowing($user);

        return back()->with('message', ($following ? "You followed "  : "You unfollowed ") . $user->name);
    }
}
