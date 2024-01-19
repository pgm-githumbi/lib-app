<?php

namespace Database\Factories;

use App\Models\Category;
use App\Traits\Tables;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
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
            'name' => $this->faker->name(),
            'publisher' => $this->faker->unique()->sentence(1),
            'isbn' => $this->faker->unique()->sentence(1),
            'description' => $this->faker->unique()->sentence(1),
            'pages' => $this->faker->unique()->numberBetween(1,100),
            'image' => $this->faker->unique()->sentence(1),
            $this->bookAvailable => $this->faker->numberBetween(1,100),
            $this->bookCategory => Category::inRandomOrder()->first(),
        ];
    }
}
