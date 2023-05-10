<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnseignantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Enseignant', function (Blueprint $table) {
            $table->id();
            $table->string('PPR');
            $table->string('Nom');
            $table->string('prenom');
            $table->date('Date_Naissance');
            $table->bigInteger('Etablissement');
            $table->foreign('Etablissement')->references('id')->on('Etablissement');
            $table->bigInteger('id_Grade');
            $table->foreign('id_Grade')->references('id_Grade')->on('Grade');
            $table->bigInteger('id_user');
            $table->foreign('id_user')->references('id_user')->on('Users');
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
        Schema::dropIfExists('Enseignant');
    }
}
