<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class ProductPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function create(User $user){
        return($user->role =='owner' ? Response::allow() : Response::deny('Only owner can create new product'));
    }

    public function delete(User $user){
        return($user->role =='owner' ? Response::allow() : Response::deny('Only owner can create new type'));
    }
}
