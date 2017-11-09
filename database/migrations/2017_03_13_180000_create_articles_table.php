<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	Schema::create('articles', function(Blueprint $table)
		{
            $table->engine ='InnoDB';
            $table->increments('id');
            $table->enum('type',array('post','page','block','theme','custom'));
            $table->enum('status',array('published','draft','trash','archive'));
            $table->string('title',255);
            $table->string('url',255);
            $table->text('content');
            $table->text('excerpt');
            $table->string('thumbnail',255);
            $table->integer('author_id')->references('id')->on('users');
            $table->dateTime('date');
            $table->timestamps();

            $table->index('url');
            $table->index('author_id');
            $table->index('type');
		});

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
