<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('votes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('contenu_id')->unsigned()->index();
            $table->integer('user_id')->unsigned()->index();
            $table->integer('user_hash')->unsigned()->index();
            $table->integer('ip')->unsigned();
            $table->string('user_agent',512);

            $table->boolean('vote_up');
            $table->boolean('vote_down');

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
        Schema::dropIfExists('votes');
    }
}
