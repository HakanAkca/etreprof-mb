<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFeaturedEmbedArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	Schema::table('articles', function ($table) {
	    	$table->boolean('featured')->after('status')->default(0);
	    	$table->text('embed')->after('featured')->default('');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('articles', function($table) {
        	$table->dropColumn('featured');
        	$table->dropColumn('embed');
		});
    }
}
