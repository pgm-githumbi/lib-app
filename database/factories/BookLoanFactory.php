<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\User;
use App\Models\BookLoan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BookLoan>
 */
class BookLoanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $loan_date = $this->faker->dateTimeThisCentury();
        $due_date = $this->faker->dateTimeInInterval($loan_date, '+50 days');
        $return_date = $this->faker->dateTimeInInterval($due_date, '+50 days');
        
        return [
            "user_id" => User::inRandomOrder()->first(),
            "book_id" => Book::inRandomOrder()->first(),
            "loan_status" => $this->faker->randomElement(
                [BookLoan::UNPAID, BookLoan::PAID]
            ),
            "loan_date" => $loan_date,
            "due_date"=>$due_date,
            "return_date" => $this->faker->randomElement([
                null, $return_date
            ]),
            "added_by" => User::inRandomOrder()->first(),
        ];
    }
}
