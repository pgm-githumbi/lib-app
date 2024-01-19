<?php

namespace Database\Factories;

use App\Models\BookLoan;
use App\Traits\Tables;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Penalty>
 */
class PenaltyFactory extends Factory
{
    use Tables;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $penAmt = $this->faker->numberBetween(0,1000);
        return [
            $this->penaltiesLoan => BookLoan::factory(1)->create()->first(),
            $this->penaltiesAmount => $penAmt,   
            $this->penaltiesAmountPaid => $this->faker->numberBetween(0, $penAmt),  
        ];
    }
}
