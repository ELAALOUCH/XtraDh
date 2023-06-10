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
            $table->unsignedBigInteger('id_Intervenant');
            $table->foreign('id_Intervenant')->references('id')->on('enseignants')->onDelete('set null');
            $table->unsignedBigInteger('id_Etab');
            $table->foreign('id_Etab')->references('id')->on('etablissements')->onDelete('set null');
            $table->float('VH')->default(0);
            $table->float('Taux_H');
            $table->float('Brut')->storedAs(' "VH" * "Taux_H" ');
            $table->float('IR')->default(0.38);
            $table->float('NET')->storedAs(' "VH" * "Taux_H" * (1-"IR")');
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
        Schema::dropIfExists('paiements');
    }
}
