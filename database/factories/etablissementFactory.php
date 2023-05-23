<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class etablissementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'Nom' => $this->faker->company,
            'code' => $this->faker->unique()->randomNumber,
            'Telephone' => $this->faker->phoneNumber,
            'Faxe' => $this->faker->phoneNumber,
            'ville' => $this->faker->city,
            'Nbr_enseignants' => $this->faker->numberBetween(1, 50),
        ];
    }
}
