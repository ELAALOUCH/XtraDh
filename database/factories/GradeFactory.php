<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class GradeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
        'designation' => $this->faker->randomElement(['Grade A', 'Grade B', 'Grade C']),
        'charge_statutaire' => $this->faker->numberBetween(10, 50),
        'Taux_horaire_Vocation' => $this->faker->numberBetween(10, 50),
        ];
    }
}
