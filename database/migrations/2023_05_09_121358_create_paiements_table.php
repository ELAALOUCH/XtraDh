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
            $table->foreign('id_Intervenant')->references('id')->on('enseignants')->onDelete('cascade');
            $table->unsignedInteger('id_Etab');
            $table->foreign('id_Etab')->references('id')->on('etablissements');
            $table->float('VH')->default(0);
            $table->float('Taux_H');
            $table->float('Brut')->default(0);
            $table->float('IR')->default(0.38);
            $table->float('NET')->default(0);
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
