<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInterventionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interventions', function (Blueprint $table) {
            $table->id('id_Intervention');
            $table->unsignedInteger('id_Intervenant');
            $table->foreign('id_Intervenant')->references('id')->on('enseignants');
            $table->unsignedInteger('id_Etab');
            $table->foreign('id_Etab')->references('id')->on('etablissements');
            $table->string('Intitule_Intervention');
            $table->string('Annee_univ',10);
            $table->string('Semestre');
            $table->date('Date_debut');
            $table->date('Date_fin');
            $table->integer('Nbr_heures');
            $table->integer('visa_etb')->default(0);
            $table->integer('visa_uae')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('interventions');
    }
}
