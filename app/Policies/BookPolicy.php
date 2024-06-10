<?php

namespace App\Policies;

use App\Models\Book;
use App\Models\User;
use App\Traits\AuthorizationNames;
use Illuminate\Auth\Access\Response;

class BookPolicy
{
    use AuthorizationNames;
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //return $user->can($this->permissionNames['view-book']);
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Book $book): bool
    {
        return true;
    }
    
    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasRole($this->roleNames['admin']);
        //
    }
    
    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Book $book): bool
    {
        return false;
        //
    }
    
    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Book $book): bool
    {
        //
        return false;
    }
    
    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Book $book): bool
    {
        return false;
        //
    }
    
    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Book $book): bool
    {
        return false;
        //
    }
}
