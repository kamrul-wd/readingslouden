<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddClassColumnToPageExtras extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('page_extras', function (Blueprint $table) {
            //
            $table->string('body_class')->nullable()->after('browser_title');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('page_extras', function (Blueprint $table) {
            //
            $table->dropColumn('body_class');
        });
    }
}
