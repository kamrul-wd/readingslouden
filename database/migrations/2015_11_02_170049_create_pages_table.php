<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('parent_id')->unsigned()->index()->nullable();
            $table->integer('lft')->unsigned()->index()->nullable();
            $table->integer('rgt')->unsigned()->index()->nullable();
            $table->integer('depth')->unsigned()->nullable();
            $table->string('heading');
            $table->string('template', 60)->nullable()->default(null);
            $table->string('child_template', 60)->nullable()->default(null);
            $table->string('slug');
            $table->text('excerpt');
            $table->longText('content');
            $table->boolean('active');
            $table->boolean('on_main_nav')->default(1);
            $table->boolean('protected')->default(0);

            $table->timestamps();

            $table->foreign('parent_id')->references('id')->on('pages');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pages');
    }
}
