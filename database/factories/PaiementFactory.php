<?php
namespace Database\Factories;
use Faker\Generator as Faker;
use App\Models\Paiement;
use App\Models\Enseignant;
use App\Models\Etablissement;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaiementFactory extends Factory
{
    protected $model = Paiement::class;

    public function definition()
    {
        $enseignant = Enseignant::factory()->create();
        $etablissement = Etablissement::factory()->create();

        return [
            'id_Intervenant' => $enseignant->id,
            'id_Etab' => $etablissement->id,
            'VH' => $this->faker->randomFloat(2, 10, 50),
            'Taux_H' => $this->faker->randomFloat(2, 10, 50),
            'Brut' => $this->faker->randomFloat(2, 1000, 9000),
            'IR' => $this->faker->randomFloat(2, 25, 45),
            'Annee_univ' => $this->faker->randomElement(['2022','2021','2023']),
            'Semestre' => $this->faker->randomElement(['Semestre 1', 'Semestre 2']),
        ];
    }
}