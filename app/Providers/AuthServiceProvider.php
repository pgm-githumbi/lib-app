<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Book;
use App\Models\BookLoan;
use App\Policies\BookPolicy;
use App\Policies\PenaltyPolicy;
use App\Policies\BookLoanPolicy;
use App\Policies\BorrowPolicy;
use App\Policies\CategoryPolicy;
use App\Traits\AuthorizationNames;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    use AuthorizationNames;
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        BookLoan::class => BookLoanPolicy::class,
        Book::class => BookPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        
        Gate::define('publish-loan', [BookLoanPolicy::class, 'create']);
        Gate::define($this->permNames['get-loans'], [BookLoanPolicy::class, 'viewAny']);
        Gate::define($this->permNames['put-loan'], [BookLoanPolicy::class, 'update']);
        Gate::define($this->permNames['get-loan'], [BookLoanPolicy::class, 'view']);
        Gate::define($this->permNames['post-loan'], [BookLoanPolicy::class, 'create']);
    
    
    
        Gate::define($this->permNames['get-borrows'], [BorrowPolicy::class, 'viewAny']);
        Gate::define($this->permNames['get-borrow'], [BorrowPolicy::class, 'view']);
        Gate::define($this->permNames['post-borrow'], [BorrowPolicy::class, 'create']);
        Gate::define($this->permNames['put-borrow'], [BorrowPolicy::class, 'update']);
        Gate::define($this->permNames['delete-borrow'], [BorrowPolicy::class, 'delete']);


    

        Gate::define($this->permNames['post-category'], [CategoryPolicy::class, 'create']);
        Gate::define($this->permNames['remove-category'], [CategoryPolicy::class, 'delete']);
        Gate::define($this->permNames['remove-category'], [CategoryPolicy::class, 'forceDelete']);
        Gate::define($this->permNames['put-category'], [CategoryPolicy::class, 'update']);
        
        
        Gate::define($this->permNames['get-penalties'], [PenaltyPolicy::class, 'viewAny']);
        Gate::define($this->permNames['get-penalty'], [PenaltyPolicy::class, 'view']);
        Gate::define($this->permNames['post-penalty'], [PenaltyPolicy::class, 'create']);
        Gate::define($this->permNames['put-penalty'], [PenaltyPolicy::class, 'update']);
        Gate::define($this->permNames['remove-penalty'], [PenaltyPolicy::class, 'delete']);
        Gate::define($this->permNames['remove-penalty'], [PenaltyPolicy::class, 'forceDelete']);
        
        
        
    }
}
