<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('label');
            $table->string('filename');
            $table->integer('size');
            $table->string('extension');
            $table->string('dimensions')->nullable();
            $table->string('file_type');
            $table->integer('original_id')->unsigned()->nullable();
            $table->integer('media_preset_id')->unsigned()->nullable();

            $table->timestamps();

            $table->foreign('original_id')->references('id')->on('media')->onDelete('set null');
            $table->foreign('media_preset_id')->references('id')->on('media_presets')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('media');
    }
}
