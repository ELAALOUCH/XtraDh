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
        Schema::create('enseignants', function (Blueprint $table) {
            $table->id();
            $table->string('PPR');
            $table->string('Nom');
            $table->string('prenom');
            $table->date('Date_Naissance');
            $table->unsignedInteger('Etablissement');
            $table->foreign('Etablissement')->references('id')->on('etablissements');
            $table->unsignedInteger('id_Grade');
            $table->foreign('id_Grade')->references('id_Grade')->on('grades');
            $table->unsignedInteger('id_user');
            $table->foreign('id_user')->references('id_user')->on('users');
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
