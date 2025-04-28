<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Equipo>
 */
class EquipoFactory extends Factory
{
    /**
     * Define the model's default state.
     * $table->string('nombre');
     * $table->text('descripcion')->nullable();
     * $table->date('fecha_creacion')->nullable();
     * $table->string('ubicacion')->nullable();
     * $table->integer('user_id');
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre'=>fake()->name(),
            'descripcion'=>fake()->words(10, true),
            'fecha_creacion' =>fake()->dateTimeBetween('-1 year', 'now'),
            'ubicacion'=>fake()->word(),
            'user_id' => fake()->numberBetween(1,10),
        ];
    }
}
