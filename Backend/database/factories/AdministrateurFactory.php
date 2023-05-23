<?php

namespace Database\Factories;

use Faker\Generator as Faker;
use App\Models\Administrateur;
use App\Models\User;
use App\Models\Etablissement;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdministrateurFactory extends Factory
{
    protected $model = Administrateur::class;

    public function definition()
    {
        $user = User::factory()->create();
        $etablissement = Etablissement::factory()->create();

        return [
            'PPR' => $this->faker->unique()->numberBetween(100000, 999999),
            'Nom' => $this->faker->lastName,
            'prenom' => $this->faker->firstName,
            'Etablissement' => $etablissement->id,
            'id_user' => $user->id_user,
        ];
    }
}