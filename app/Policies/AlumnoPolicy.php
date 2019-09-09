<?php

namespace App\Policies;

use App\User;
use App\Alumno;
use Illuminate\Auth\Access\HandlesAuthorization;

class AlumnoPolicy
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

        public function hijo(User $user, Alumno $alumno)
    {
       return $user->user === $alumno->apoderado;
    }
}
