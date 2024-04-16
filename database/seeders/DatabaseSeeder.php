<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Book;
use App\Models\User;
use App\Models\Borrow;
use App\Models\Penalty;
use App\Models\BookLoan;
use App\Models\Category;
use App\Models\Extension;
use Illuminate\Database\Seeder;
use App\Traits\AuthorizationNames;
use Spatie\Permission\Models\Role;
use Database\Factories\PenaltyFactory;

class DatabaseSeeder extends Seeder
{
    use AuthorizationNames;
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        
        $staff = Role::findOrCreate($this->roleNames['staff']);
        $admin = Role::findOrCreate($this->roleNames['admin']);
        $student = Role::findOrCreate($this->roleNames['student']);
        User::factory(13)->create();
        User::factory(5)->staff()->create();
        User::factory(5)->admin()->create();
        Category::factory(20)->create();
        Book::factory(17)->create();
        BookLoan::factory(28)->create();
        Penalty::factory(20)->create();
        Extension::factory(10)->create();
        Borrow::factory(20)->create();
        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
