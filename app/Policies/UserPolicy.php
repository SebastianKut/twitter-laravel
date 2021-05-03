<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    //first argument is the logged in user, second can be anything as per controller wildcard, so Post, another user etc, in this case another user that profile we are visiting
    public function edit(User $currentUser, User $user)
    {
        //authorise to edit profile if current user is that user
        //we can than add middleware to our profile/{user}/edit route

        return $currentUser->name === $user->name;
    }

    //not sure if calling the function follow is a good practice or should it be called something else
    public function follow(User $currentUser, User $user)
    {
        //authorise to edit profile if current user is that user
        //we can than add middleware to our profile/{user}/edit route

        return $currentUser->name !== $user->name;
    }
}
