<?php
namespace Database\Factories;

use Faker\Generator as Faker;
use App\Models\Enseignant;
use App\Models\Grade;
use App\Models\User;
use App\Models\Etablissement;
use Illuminate\Database\Eloquent\Factories\Factory;

class EnseignantFactory extends Factory
{
    protected $model = Enseignant::class;

    public function definition()
    {
        $grade = Grade::factory()->create();
        $user = User::factory()->create();
        $etab = etablissement::factory()->create();

        return [
            'PPR' => $this->faker->unique()->numberBetween(100000, 999999),
            'Nom' => $this->faker->lastName,
            'prenom' => $this->faker->firstName,
            'Date_Naissance' => $this->faker->dateTimeBetween('1960-01-01', '1994-12-31'),
            'Etablissement' => $etab->id,
            'id_Grade' => $grade->id_Grade,
            'id_user' => $user->id_user,
        ];
    }
}