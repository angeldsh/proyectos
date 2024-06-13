<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Alquiler;
use App\Models\Calificacion;
use App\Models\Pelicula;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        User::factory()->create([
            'username' => 'angel',
            'password' => Hash::make('1234'),
            'email' => 'angel@gmail.com'
        ]);

        //Pelicula::factory(10)->create();

        //Alquiler::factory(10)->create();

        //Calificacion::factory(10)->create();
    }

}
