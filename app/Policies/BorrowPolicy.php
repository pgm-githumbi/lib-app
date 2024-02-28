<?php

namespace App\Policies;

use App\Models\Borrow;
use App\Models\User;
use App\Traits\AuthorizationNames;
use Illuminate\Auth\Access\Response;

class BorrowPolicy
{

    use AuthorizationNames;
    public function before(User $user){
        if($user->hasRole($this->roleNames['admin']))
            return true;
        return null;
    }
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Borrow $borrow): bool
    {
        return $borrow->user->id == $user->id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Borrow $borrow): bool
    {
        return $borrow->user->id == $user->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Borrow $borrow): bool
    {
        return $borrow->user->id == $user->id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Borrow $borrow): bool
    {
        return $borrow->user->id == $user->id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Borrow $borrow): bool
    {
        return $borrow->user->id == $user->id;
    }
}
