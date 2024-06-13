<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Alquiler>
 */
class AlquilerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'pelicula_id' => $this->faker->numberBetween(1, 10),
            'usuario_id' => $this->faker->numberBetween(1, 10),
            'fecha_alquiler' => $this->faker->dateTime(),
            'fecha_devolucion' => $this->faker->optional()->dateTime(),
        ];
    }
}
