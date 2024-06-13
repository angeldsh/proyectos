<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pelicula>
 */
class PeliculaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'titulo' => $this->faker->sentence,
            'director' => $this->faker->name,
            'fechaEstreno' => $this->faker->date(),
            'edad' => $this->faker->numberBetween(0, 18),
            'reparto' => $this->faker->words(3, true),
            'genero' => $this->faker->word,
            'sinopsis' => $this->faker->paragraph,
            'duracion' => $this->faker->numberBetween(60, 180),
            'foto' => $this->faker->imageUrl( 640, 480),
            'precio' => $this->faker->numberBetween(5, 20)
        ];
    }
}
