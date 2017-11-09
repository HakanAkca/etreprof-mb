<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddScoreContenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contenus', function (Blueprint $table) {
            $table->decimal('score_avis',5,2)->after('auteur')->unsigned()->default(0);
            $table->smallInteger('score_upvote')->after('score_avis')->unsigned()->default(0);
            $table->smallInteger('score_downvote')->after('score_upvote')->unsigned()->default(0);

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
			$table->dropColumn('score_avis');
			$table->dropColumn('score_upvote');
			$table->dropColumn('score_downvote');
		});
    }
}
