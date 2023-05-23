<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         \App\Models\User::factory(10)->create();
         // \App\Models\grade::factory(10)->create();
          \App\Models\etablissement::factory(10)->create();
          \App\Models\administrateur::factory(10)->create();
         \App\Models\Enseignant::factory(10)->create();
         \App\Models\intervention::factory(10)->create();
         \App\Models\paiement::factory(10)->create();


    }
}
