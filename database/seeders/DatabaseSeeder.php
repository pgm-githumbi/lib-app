<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Book;
use App\Models\User;
use App\Models\Penalty;
use App\Models\BookLoan;
use App\Models\Category;
use App\Models\Extension;
use Illuminate\Database\Seeder;
use Database\Factories\PenaltyFactory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(40)->create();
        Category::factory(40)->create();
        Book::factory(40)->create();
        BookLoan::factory(40)->create();
        Penalty::factory(40)->create();
        Extension::factory(30)->create();
        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
