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
        Schema::create('Intervention', function (Blueprint $table) {
            $table->id('id_intervention');
            $table->bigInteger('id_Intervenant');
            $table->foreign('id_Intervenant')->references('id')->on('Enseignant');
            $table->bigInteger('id_Etab');
            $table->foreign('id_Etab')->references('id')->on('Etablissement');
            $table->string('Intitule_Intervention');
            $table->string('Annee_univ',10);
            $table->string('Semestre');
            $table->date('Date_debut');
            $table->date('Date_fin');
            $table->integer('Nbr_heures');
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
        Schema::dropIfExists('Intervention');
    }
}
