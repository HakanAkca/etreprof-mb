<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contenus', function (Blueprint $table) {
            $table->increments('id');
            $table->string('titre');
            $table->string('url',512);
			$table->enum('etat',['en_construction','propose','evalue','publie','corbeille','efface'])->index();

            $table->string('auteur');
            $table->string('source_url',512)->nullable();
            $table->smallInteger('duree_secondes')->nullable();
            $table->enum('format', ['video','liens']);

            $table->string('images',1024)->default('');
            $table->string('decoder')->nullable();
            $table->string('embed_url')->nullable();
            //$table->smallInteger('duree_secondes');
            //$table->string('description',512);
            //$table->string('description',512);

            $table->string('lien_description',512)->nullable();
            $table->string('lien_titre',512)->nullable();

            $table->string('tags',1024)->nullable();

            //$table->tinyInteger('ordre')->unsigned();
            $table->integer('vignette_id')->index()->nullable();
            $table->integer('propose_par_id')->index();
            $table->integer('valide_par_id')->nullable();
            $table->integer('affecte_a_id')->index()->nullable();
            $table->text('description')->nullable();
            $table->text('data')->nullable();
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
        Schema::dropIfExists('contenus');
    }
}
