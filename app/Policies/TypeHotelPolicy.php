<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class TypeHotelPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function create(User $user){
        return($user->role =='staff' ? Response::allow() : Response::deny('Only owner can create type hotel'));
    }

    public function delete(User $user){
        return($user->role =='staff' ? Response::allow() : Response::deny('Only staff can delete type hotel'));
    }
}
