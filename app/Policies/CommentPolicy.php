<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    public function destroy(User $currentUser, Comment $comment)
    {
        return $currentUser->id === $comment->user_id;
    }
}
