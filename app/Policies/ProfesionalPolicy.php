<?php

namespace App\Policies;

use App\Models\Profesional;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProfesionalPolicy
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

    public function create(User $user, Profesional $profesional) 
    {
        return true; //Hacer logica de creacion y permisos
    }
}
