<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Penalty;
use App\Models\User;
use App\Models\BookLoan;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DeleteEveryThingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement("SET FOREIGN_KEY_CHECKS=0");
        Penalty::truncate();
        Category::truncate();
        BookLoan::truncate();
        Book::truncate();
        User::truncate();
        DB::statement("SET FOREIGN_KEY_CHECKS=1");
        
    }

    private function deleter($model) {
        foreach($model::all() as $model) {
            $model->delete();
        }
    }
}
