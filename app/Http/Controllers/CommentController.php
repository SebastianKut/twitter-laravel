<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Tweet;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Tweet $tweet)
    {
        $validatedComment = request()->validate([
            'body'       => ['required', 'max:255'],
        ]);

        Comment::create([
            'user_id'   => auth()->id(),
            'tweet_id'  => $tweet->id,
            'body'      => $validatedComment['body'],
        ]);

        //redirect
        return redirect('/tweets')->with('message', 'Your comment was added');
    }

    public function destroy(Comment $comment)
    {
        $comment->deleteComment();

        return back()->with('message', 'Your comment was deleted');
    }
}
