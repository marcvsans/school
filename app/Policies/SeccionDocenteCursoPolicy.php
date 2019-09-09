<?php

namespace App\Policies;

use App\User;
use App\SeccionDocenteCurso;
use Illuminate\Auth\Access\HandlesAuthorization;

class SeccionDocenteCursoPolicy
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


  public function owner(User $user, SeccionDocenteCurso $seccion)
    {
       return $user->user === $seccion->docente;
    }

}
