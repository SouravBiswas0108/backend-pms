<?php

namespace App\Policies;

use App\Models\OperationAndProcessDetails;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class OperationAndProcessDetailsPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, OperationAndProcessDetails $operationAndProcessDetails): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, OperationAndProcessDetails $operationAndProcessDetails): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, OperationAndProcessDetails $operationAndProcessDetails): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, OperationAndProcessDetails $operationAndProcessDetails): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, OperationAndProcessDetails $operationAndProcessDetails): bool
    {
        //
    }
}
