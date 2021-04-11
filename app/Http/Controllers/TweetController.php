<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tweet;

class TweetController extends Controller
{
    public function store()
    {
        //validation
        $validatedTweet = request()->validate([
            'body'  => ['required', 'max:255']
        ]);

        //store to database
        Tweet::create([
            'user_id'   => auth()->id(),
            'body'      => $validatedTweet['body']
        ]);

        //redirect
        return redirect('/home');
    }
}
