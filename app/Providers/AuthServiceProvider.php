<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
         'App\SeccionDocenteCurso' => 'App\Policies\SeccionDocenteCursoPolicy',
         'App\Matricula' => 'App\Policies\MatriculaPolicy',
         'App\Deuda' => 'App\Policies\DeudaPolicy',
         'App\Alumno' => 'App\Policies\AlumnoPolicy',
        'App\AnioAcademico' => 'App\Policies\AnioAcademicoPolicy',

    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
