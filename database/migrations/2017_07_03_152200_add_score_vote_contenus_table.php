<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddScoreVoteContenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contenus', function (Blueprint $table) {
            $table->decimal('note')->after('score_downvote')->unsigned()->nullable();
            $table->tinyInteger('nb_votes')->after('note')->unsigned()->default(0);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contenus', function(Blueprint $table) {
            $table->dropColumn('note');
            $table->dropColumn('nb_votes');
        });
    }
}