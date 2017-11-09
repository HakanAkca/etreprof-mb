<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiscussionMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discussion_messages', function (Blueprint $table) {
            $table->increments('id');            
            $table->mediuminteger('from_user_id')->unsigned()->index();
            $table->mediuminteger('to_user_id')->unsigned()->index();
            $table->integer('discussion_id')->unsigned()->index();
            $table->enum('status', ['unread', 'read', 'spam'])->default('unread');
            $table->text('message')->default('');
            $table->timestamps();
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('discussion_messages');
    }
}
