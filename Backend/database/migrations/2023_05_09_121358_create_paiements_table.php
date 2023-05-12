<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaiementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paiements', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('id_Intervenant');
            $table->foreign('id_Intervenant')->references('id')->on('enseignants');
            $table->unsignedInteger('id_Etab');
            $table->foreign('id_Etab')->references('id')->on('etablissements');
            $table->float('VH');
            $table->float('Taux_H');
            $table->float('Brut');
            $table->float('IR');
            $table->string('Annee_univ',10);
            $table->string('Semestre');
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
        Schema::dropIfExists('Paiements');
    }
}
