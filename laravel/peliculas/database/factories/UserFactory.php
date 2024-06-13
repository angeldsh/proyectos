<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'username' => $this->faker->unique()->userName,
            'password' => static::$password ??= Hash::make('password'),
            'email' => $this->faker->unique()->safeEmail,
            'nombre' => $this->faker->firstName,
            'apellido1' => $this->faker->lastName,
            'apellido2' => $this->faker->lastName,
            'direccion' => $this->faker->address,
            'nif' => $this->faker->unique()->regexify('[0-9]{9}'),
            'foto' => $this->faker->imageUrl(),
            'activo' => $this->faker->boolean,
            'bloqueado' => $this->faker->boolean,
            'num_intentos' => $this->faker->numberBetween(0, 3),
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
}
