<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\CodigoPostal;

class CodigoPostalPolicy
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

    public function create(User $user, CodigoPostal $cp) 
    {
        return true; //Hacer logica de creacion y permisos
    }
}
