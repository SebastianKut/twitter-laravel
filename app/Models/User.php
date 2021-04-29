<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
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

// Creating custom accesor function that we can call its value from the view for example {{$tweet->user->avatar}}
    public function getAvatarAttribute()
    {
        return 'https://i.pravatar.cc/50?u=' . $this->email;
    }


    public function timeline()
    {
        //return tweets of the user and his idols (people user follows)

        $ids = $this->idols()->pluck('idol_user_id');   // array of idols ids
        $ids->push($this->id);                         // add user id to the array

        return Tweet::whereIn('user_id', $ids)->latest()->get();
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

    public function getRouteKeyName()
    {
        return 'name';
    }


}
