<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvenementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evenements', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('date_debut')->index();
            $table->dateTime('date_fin')->index()->nullable();
            $table->text('titre');
            $table->text('description');
            $table->integer('auteur_id')->unsigned();
            $table->enum('statut', ['brouillon', 'publie', 'corbeille'])->default('brouillon');
            $table->text('code_integration');
            $table->integer('nb_interesses');
            $table->softDeletes();
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
        Schema::dropIfExists('evenements');
    }
}