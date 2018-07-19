<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddConstraintsForProductLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_logs', function (Blueprint $table) {
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('sold_by')->references('id')->on('users');
            $table->foreign('sold_to')->references('id')->on('buyers');
            //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_logs', function (Blueprint $table) {
            $table->dropForeign(['product_id']);            
            $table->dropForeign(['sold_by']);            
            $table->dropForeign(['sold_to']);            
            //
        });
    }
}
