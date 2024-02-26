<?php

namespace App\Policies;

use App\Models\Customer;
use App\Models\usuario;
use Illuminate\Auth\Access\Response;

class CustomerPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(usuario $usuario): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(usuario $usuario, Customer $customer): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(usuario $usuario): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(usuario $usuario, Customer $customer): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(usuario $usuario, Customer $customer): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(usuario $usuario, Customer $customer): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(usuario $usuario, Customer $customer): bool
    {
        //
    }
}
