<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdministrateursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Administrateur', function (Blueprint $table) {
            $table->id();
            $table->string('PPR');
            $table->string('Nom');
            $table->string('prenom');
            $table->bigInteger('Etablissement');
            $table->foreign('Etablissement')->references('id')->on('Etablissement');
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
        Schema::dropIfExists('Administrateur');
    }
}
