<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use App\Models\User;
use Illuminate\Http\Request;

class TweetLikesController extends Controller
{
    public function store(Tweet $tweet, User $user)
    {
        $tweet->like($user->id);

        return back();
    }

    public function destroy(Tweet $tweet, User $user)
    {
        $tweet->dislike($user->id);

        return back();
    }
}
