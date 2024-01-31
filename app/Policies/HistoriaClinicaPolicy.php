<?php

namespace App\Policies;

use App\Models\HistoriaClinica;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class HistoriaClinicaPolicy
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

    public function create(User $user, HistoriaClinica $historiaClinica) 
    {
        return true; //Hacer logica de creacion y permisos
    }
}
