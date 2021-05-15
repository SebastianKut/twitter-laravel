<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'avatar',
        'background_img',
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Creating custom accesor function that we can call its value from the view for example {{$tweet->user->avatar}}, Laravel will know to call this function when called $tweet->user->avatar
    public function getAvatarAttribute($value)
    {
        //show avatar from database or else default avatar
        // if ($value) {
        //     return asset('storage/' . $value);
        // }

        // return '/images/default_avatar.jpg';

        //OR

        return asset($value ? 'storage/' . $value : '/images/default_avatar.jpg');
    }

    public function getBackgroundImgAttribute($value)
    {

        if ($value) {
            return asset('storage/' . $value);
        }

        return '/images/default_bg.jpg';
    }


    //This mutator makes sure that when you edit profile and ask for password, then u update db with the password it hashes it
    public function setPasswordAttribute($password)
    {
        //make sure that it does not rehash hashed passwords otherwise it will rehash hashed passoword when registering
        $this->attributes['password'] = Hash::needsRehash($password) ? Hash::make($password) : $password;
    }


    public function timeline()
    {
        //return tweets of the user and his idols (people user follows)

        $ids = $this->idols()->pluck('idol_user_id');   // array of idols ids
        $ids->push($this->id);                         // add user id to the array

        return Tweet::whereIn('user_id', $ids)->latest()->paginate(50);
    }


    //To call function that relates to eloquent like below you can call 'User::find(1)->tweets' which will return all tweets. This happens through magic function specific to laravel
    // If you call tweets(), this will invoke query builder so you can do something like: only return body of a tweet: 'User::find(1)->tweets()->pluck('body')'

    public function tweets()
    {
        return $this->hasMany(Tweet::class);
    }

    public function follow(User $user)
    {
        return $this->idols()->attach($user);
    }

    public function unfollow(User $user)
    {
        return $this->idols()->detach($user);
    }

    public function isFollowing(User $user)
    {
        return $this->idols()->where('idol_user_id', $user->id)->exists();
    }

    public function toggleFollow(User $user)
    {
        if ($this->isFollowing($user)) {
            return $this->unfollow($user);
        }

        return $this->follow($user);
    }

    public function idols()
    {
        //Belongs to many because eventhough User doesnt have idol_id technicaly idol_id is just another users id (this is kinda weird case)
        //Normaly belongsToMany is used when table has foreign key for example posts table has user_id
        //instead of idols this pivot table could be called user_user but it wouldnt make much sense in this case. Thats how laravel by default looks for those tables, but in this case I am explicit calling it 'idols'
        return $this->belongsToMany(User::class, 'idols', 'user_id', 'idol_user_id');
    }

    // To get followers for user its just opposite relationship of showing by idol_user_id
    public function fans()
    {
        return $this->belongsToMany(User::class, 'idols', 'idol_user_id', 'user_id');
    }

    // public function getRouteKeyName()
    // {
    //     return 'name';
    // }
}
