<?php

namespace Database\Factories;

use Faker\Generator as Faker;
use App\Models\Intervention;
use App\Models\Enseignant;
use App\Models\Etablissement;
use Illuminate\Database\Eloquent\Factories\Factory;

class InterventionFactory extends Factory
{
    protected $model = Intervention::class;

    public function definition()
    {
        $enseignant = Enseignant::factory()->create();
        $etablissement = Etablissement::factory()->create();
        $date_debut = $this->faker->date();
        $date_fin = $this->faker->date($startDate = $date_debut);

        return [
            'id_Intervenant' => $enseignant->id,
            'id_Etab' => $etablissement->id,
            'Intitule_Intervention' => $this->faker->sentence,
            'Annee_univ' => $this->faker->randomElement(['2022', '2023', '2021']),
            'Semestre' => $this->faker->randomElement(['Semestre 1', 'Semestre 2']),
            'Date_debut' => $date_debut,
            'Date_fin' => $date_fin,
            'Nbr_heures' => $this->faker->numberBetween(10, 50),
        ];
    }
}