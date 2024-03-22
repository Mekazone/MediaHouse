<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOpinionAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('opinion_attachments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('filePosition');
            $table->integer('fileCategoryId');
            $table->string('caption')->nullable();
            $table->string('slug');
            $table->integer('postId');
            $table->foreign('postId')->references('id')->on('opinions');
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
        Schema::dropIfExists('opinion_attachments');
    }
}
