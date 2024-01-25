<?php

namespace App\Policies;

use App\Models\User;
use App\Models\BookLoan;
use App\Traits\AuthorizationNames;
use Illuminate\Support\Facades\Log;
use Illuminate\Auth\Access\Response;

class BookLoanPolicy
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
        return $user->can($this->permNamesSpatie['view-loans']);
    }
    
    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, BookLoan $bookLoan): bool
    {
        return $bookLoan->user->id == $user->id;
    }
    
    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // return $user->can($this->permNamesSpatie['create-loan']);
        return false;
    }
    
    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, BookLoan $bookLoan): bool
    {
        // return $user->can($this->permNames['put-loan'], $bookLoan);
        return false;
        
    }
    
    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, BookLoan $bookLoan): bool
    {
        // return $user->can($this->permNamesSpatie['delete-loan']);
        return false;
    }
    
    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, BookLoan $bookLoan): bool
    {
        // return $user->can($this->permNamesSpatie['restore-loan']);
        return false;
    }
    
    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, BookLoan $bookLoan): bool
    {
        // return $user->can($this->permNamesSpatie['force-delete-loan']);
        return false;
    }
}
