<?php

namespace Database\Factories;

use App\Models\User;
use App\Traits\AuthorizationNames;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    use AuthorizationNames;
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
    
    public function staff(): static
    {
        return $this->state(fn (array $attributes) => [
            'name' => 'staff_'.fake()->name(),
            ])->afterCreating(function (User $user){
                $user->assignRole($this->roleNames['staff']);
            });
    }

    public function knownStaff(): static
    {
        return $this->state(fn (array $attributes) => [
            'name' => 'MainStaffExample',
            'email' => 'MainStaffExample@example.com',
        ])->afterCreating(function (User $user)  {
            $user->assignRole($this->roleNames['staff']);
        });
    }

    public function admin(): static
    {
        return $this->state(fn (array $attributes) => [
            'name' => 'admin_'.fake()->name(),
            'password' => Hash::make('admin_password')
    ])->afterCreating(function (User $user){
        $user->assignRole($this->roleNames['admin']);
    });
    }

    public function knownAdmin(): static
    {
        return $this->state(fn (array $attributes) => [
            'name' => 'MainAdminExample',
            'email' => 'MainAdminExample@example.com',
        ])->afterCreating(function (User $user) {
            $user->assignRole($this->roleNames['admin']);
        });
    }
}
