<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUnreadDiscussionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('discussions', function (Blueprint $table) {
            $table->tinyInteger('to_unread')->unsigned()->default(0);
            $table->tinyInteger('from_unread')->unsigned()->default(0);
            $table->boolean('to_notified')->default(0);
            $table->boolean('from_notified')->default(0);            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('discussions', function(Blueprint $table) {
            $table->dropColumn('to_unread');
            $table->dropColumn('from_unread');
            $table->dropColumn('to_notified');
            $table->dropColumn('from_notified');
            
        });
    }
}
