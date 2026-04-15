<?php

namespace App\Policies;

use App\Models\Idea;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class IdeaPolicy
{
   

    /**
     * Determine whether the user can view the model.
     */
    public function update(User $user, Idea $idea): bool
    {
        return $user->id == $idea ->user_id;
        // return $users -> is($idea->user)
    }

    public function view(User $user, Idea $idea): bool
    {
        return false;
    }

    
}
