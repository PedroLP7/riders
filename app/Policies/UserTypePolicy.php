<?php

namespace App\Policies;

use App\Models\UserType;
use App\Models\usuario;
use Illuminate\Auth\Access\Response;

class UserTypePolicy
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
    public function view(usuario $usuario, UserType $usuarioType): bool
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
    public function update(usuario $usuario, UserType $usuarioType): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(usuario $usuario, UserType $usuarioType): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(usuario $usuario, UserType $usuarioType): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(usuario $usuario, UserType $usuarioType): bool
    {
        //
    }
}
