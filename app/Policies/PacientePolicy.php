<?php

namespace App\Policies;

use App\Models\Paciente;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PacientePolicy
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

    public function create(User $user, Paciente $paciente) 
    {
        return true; //Hacer logica de creacion y permisos
    }
}
