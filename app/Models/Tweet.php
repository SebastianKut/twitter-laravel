<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'body', 'image'];

    //we can use local scope to dynamically build queries by creating public function scopeName($query) {}, then we can invoke it like Tweet::name()->get()
    //This scope will add likes and dislikes column so we can invke like this Tweet::withLikes()->first()
    //This way we can add to the standard columns in the table likes and dislikes colum using left join then query them in blade for example

    //$tweet = Tweet::withLikes()->first();
    //in this example we call it withLikes() in User->timeline()

    //now we have access to all this

    // id: 1,
    //  user_id: 6,
    //  body: "First tweet",
    //  created_at: "2021-05-12 05:56:28",
    //  updated_at: "2021-05-12 05:56:28",
    //  tweet_id: 1,
    //  likes: "0",
    //  dislikes: "1",

    //then we can do this
    // $tweet->likes or $tweet->dislikes

    //if we would just do Tweet::first() then that would gives only the columns in the table
    //  id: 1,
    //  user_id: 6,
    //  body: "First tweet",
    //  created_at: "2021-05-12 05:56:28",
    //  updated_at: "2021-05-12 05:56:28",

    public function scopeWithLikes(Builder $query)
    {
        //We want to build eloquent query from our sql query

        // SELECT * FROM tweets
        // LEFT JOIN (
        //     SELECT tweet_id, sum(liked) as likes, sum(!liked) as dislikes  FROM likes GROUP BY tweet_id
        //     ) as likes
        // ON tweets.id = likes.tweet_id

        // Eloquent fro this would be
        // $query->leftJoinSub($query, $as, $conition)

        $query->leftJoinSub(
            'SELECT tweet_id, sum(liked) as likes, sum(!liked) as dislikes  FROM likes GROUP BY tweet_id',
            'likes',
            'tweets.id',
            'likes.tweet_id',
        );
    }

    public function getImageAttribute($value)
    {

        if ($value) {
            return asset('storage/' . $value);
        }
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // accepting user but not requiring it by assigning $user = null
    public function like($user = null, $liked = true)
    {
        return $this->likes()->updateOrCreate([
            'user_id' => $user ? $user->id : auth()->user()->id
        ], [
            'liked'   => $liked
        ]);
    }

    public function dislike($user = null)
    {
        return $this->like($user, false);
    }

    public function deleteLikeRecord()
    {
        return $this->likes()->where('tweet_id', $this->id)->where('user_id', auth()->user()->id)->delete();
    }

    public function isLikedBy(User $user)
    {
        return (bool) $user->likes->where('tweet_id', $this->id)->where('liked', true)->count();
    }

    public function isDislikedBy(User $user)
    {
        return (bool) $user->likes->where('tweet_id', $this->id)->where('liked', false)->count();
    }

    public function toggleLike()
    {
        return $this->isLikedBy(auth()->user()) ? $this->deleteLikeRecord() : $this->like(auth()->user());
    }

    public function toggleDislike()
    {
        return $this->isDislikedBy(auth()->user()) ? $this->deleteLikeRecord() : $this->dislike(auth()->user());
    }

    public function deleteTweet()
    {
        //find the tweet where tweet user id is current user id and delete
        //the below retriews tweet from database making sure user id equals logged in user

        // $tweet->where('id', $tweet->id)->where('user_id', auth()->user()->id)->delete();

        //this one deletes tweet without retrieving from database but doesnt prevent from deleting all tweets of all users
        //we use destroy instead of delete because we know models id so we do not have to query data base to find the right record

        return $this->destroy($this->id);
    }
}
