<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAvisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('avis', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('contenu_id')->unsigned()->index();
            $table->integer('evaluateur_id')->unsigned()->index();

            $table->tinyInteger('note_fond')->unsigned();
            $table->tinyInteger('note_forme')->unsigned();
            $table->tinyInteger('note_accessibilite')->unsigned();
            $table->boolean('waouh');

            $table->text('commentaires');
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
        Schema::dropIfExists('avis');
    }
}
