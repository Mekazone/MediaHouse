<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWitsCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wits_comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('postId');
            $table->integer('date');
            $table->string('name');
            $table->text('comment');
            $table->string('status');
            $table->foreign('postId')->references('id')->on('wits');
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
        Schema::dropIfExists('wits_comments');
    }
}
