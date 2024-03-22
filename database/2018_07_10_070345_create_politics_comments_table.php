<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePoliticsCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('politics_comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('postId');
            $table->integer('date');
            $table->string('name');
            $table->text('comment');
            $table->string('status');
            $table->foreign('postId')->references('id')->on('politics');
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
        Schema::dropIfExists('politics_comments');
    }
}
