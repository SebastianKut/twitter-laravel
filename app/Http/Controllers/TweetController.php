<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tweet;

class TweetController extends Controller
{

    public function index()
    {
        return view('tweets.index', [
            'tweets' => auth()->user()->timeline()
        ]);
    }

    public function store()
    {
        //validation
        $validatedTweet = request()->validate([
            'body'       => ['required', 'max:255'],
            'image'      => ['file'],
        ]);

        if (request('image')) {
            $validatedTweet['image'] = request('image')->store('tweets');
        } else {
            $validatedTweet['image'] = '';
        }
        //store to database
        Tweet::create([
            'user_id'   => auth()->id(),
            'body'      => $validatedTweet['body'],
            'image'     => $validatedTweet['image'],
        ]);

        //redirect
        return redirect('/tweets');
    }
}
