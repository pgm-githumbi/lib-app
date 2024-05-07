<?php

namespace App\Providers;

use App\Traits\AuthorizationNames;
use Illuminate\Support\ServiceProvider;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AppServiceProvider extends ServiceProvider
{
    use AuthorizationNames;
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        // foreach($this->permissionNames as $permission){
        //     $perm = Permission::find($this->permissionNames[$permission]);
            
        // }

        

        // $student = Role::findByName($this->roleNames['student']);
        
        // $student->givePermissionTo($this->getPermissionsStudent());
        
    }
}
