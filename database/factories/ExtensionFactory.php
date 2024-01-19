<?php

namespace Database\Factories;

use App\Models\Penalty;
use App\Traits\Tables;
use App\Models\BookLoan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Extension>
 */
class ExtensionFactory extends Factory
{
    use Tables;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            $this->extensionsLoan => BookLoan::inRandomOrder()->first(),
            $this->extensionsReturnDate => $this->faker->dateTimeBetween('now', '+60 days'),  
            $this->extensionsPenalty => Penalty::inRandomOrder()->first(),
        ];
    }
}
