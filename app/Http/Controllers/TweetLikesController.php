<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use App\Models\User;
use Illuminate\Http\Request;

class TweetLikesController extends Controller
{
    public function store(Tweet $tweet, User $user)
    {
        $tweet->toggleLike($user->id);

        return back();
    }

    public function destroy(Tweet $tweet, User $user)
    {
        $tweet->toggleDislike($user->id);

        return back();
    }
}
