<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateSoldToColumnNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_logs', function(Blueprint $table) {
            $table->dropForeign(['sold_to']);
            $table->dropColumn('sold_to');
        });

        Schema::table('product_logs', function(Blueprint $table) {
            $table->integer('sold_to')->unsigned()->nullable();
            $table->foreign('sold_to')->references('id')->on('buyers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
