<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class TypePolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function create(User $user){
        return($user->role =='owner' ? Response::allow() : Response::deny('Only staff can create new type'));
    }

    public function delete(User $user){
        return($user->role =='owner' ? Response::allow() : Response::deny('Only staff can create new type'));
    }
}
