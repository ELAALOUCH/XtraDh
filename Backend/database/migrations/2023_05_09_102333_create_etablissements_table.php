<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEtablissementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    
    public function up()
    {
        Schema::create('Etablissement', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('Nom');
            $table->string('Telephone');
            $table->string('Faxe');
            $table->string('ville');
            $table->integer('Nbr_enseignants');
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
        Schema::dropIfExists('Etablissement');
    }
}
