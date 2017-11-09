<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLiensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('liens', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('contenu_id')->unsigned()->index();
            $table->enum('etat', ['visible','efface'])->default('visible')->index();
            $table->string('url',512);
            $table->string('titre');
            $table->string('images',1024);
            $table->string('decoder');
            $table->string('embed_url');
            $table->smallInteger('duree_secondes');
            $table->string('description',512);
            $table->string('tags',1024);
            $table->tinyInteger('ordre')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('liens');
    }
}
