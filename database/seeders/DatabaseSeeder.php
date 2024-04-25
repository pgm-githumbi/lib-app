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
        User::factory(8)->create();
        User::factory(2)->staff()->create();
        User::factory(1)->knownStaff()->create();
        User::factory(1)->knownAdmin()->create();
        User::factory(2)->admin()->create();
        Category::factory(8)->create();
        Book::factory(17)->create();
        BookLoan::factory(1)->create();
        Penalty::factory(5)->create();
        Extension::factory(10)->create();
        Borrow::factory(2)->create();
        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
