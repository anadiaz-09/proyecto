<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Jugador>
 */
class JugadorFactory extends Factory
{
    /**
     * Define the model's default state.
     * $table->string('nombre');
     * $table->string('correo')->nullable();
     * $table->string('telefono')->nullable();
     * $table->date('fecha_ingreso')->nullable();
     * $table->integer('equipo_id');
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre'=>fake()->name(),
            'correo'=>fake()->email(),
            'telefono'=>fake()->numerify('########'),
            'fecha_ingreso' =>fake()->dateTimeBetween('-1 year', 'now'),
            'equipo_id' => fake()->numberBetween(1,6),

        ];
    }
}
