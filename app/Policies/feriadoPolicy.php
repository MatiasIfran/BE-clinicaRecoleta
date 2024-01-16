<?php

namespace App\Policies;

use App\Models\Feriado;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class feriadoPolicy
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

    public function create(User $user, Feriado $feriado) 
    {
        return true; //Hacer logica de creacion y permisos
    }
}
