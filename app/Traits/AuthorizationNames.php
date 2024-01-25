<?php

namespace App\Traits;

use Illuminate\Support\Facades\App;

Trait AuthorizationNames{
    protected $permNamesSpatie = [
                'view-books' => 'view-books',
                'view-book' => 'view-book',
                'create-book' => 'create-book',
                'update-book' => 'update-book',
                'delete-book' => 'delete-book',
                'view-loans' => 'view-loans',
                'view-loan' => 'view-loan',
                'create-loan' => 'create-loan',
                'update-loan' => 'update-loan',
                'delete-loan' => 'delete-loan',
                'view-categories' => 'view-categories',
                'view-category' => 'view-category',
                'create-category' => 'create-category',
                'update-category' => 'update-category',
                'delete-category' => 'delete-category',
            ];

    protected $permNames = ['get-loans' => 'get-loans',
                            'get-loan' => 'get-loan',
                            'put-loan' => 'put-loan',
                            'post-loan' => 'post-loan',
                            'remove-loan' => 'remove-loan',

                            'post-category' => 'post-category',
                            'put-category' => 'put-category',
                            'remove-category' => 'remove-category',
                            
                            'get-penalties' => 'get-penalties',
                            'get-penalty' => 'get-penalty',
                            'post-penalty' => 'post-penalty',
                            'put-penalty' => 'put-penalty',
                            'remove-penalty' => 'remove-penalty',
                            


                        ];
    
    protected function getPermissionsStudent(){
        return [
            $this->permNamesSpatie['view-books'],
            $this->permNamesSpatie['view-book'],
            $this->permNamesSpatie['view-category'],
            $this->permNamesSpatie['view-categories'],
            // $this->permissionNames['view-loan'],
            $this->permNamesSpatie['view-loans'],
    ];

    }
    protected $roleNames = ['admin' => 'super-admin', 
                            'student' => 'student'];
}