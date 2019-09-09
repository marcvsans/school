<?php

namespace App\Policies;

use App\User;
use App\Deuda;
use Illuminate\Auth\Access\HandlesAuthorization;

class DeudaPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

       public function owner(User $user, Deuda $deuda)
    {
       return $user->user === $deuda->alumno;
    }

}
