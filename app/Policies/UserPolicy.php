<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function edit(User $currentUser, User $user)
    {
        //authorise to edit profile if current user is that user
        //we can than add middle ware to our profile/{user}/edit route
        return $currentUser->is($user);
    }
}
