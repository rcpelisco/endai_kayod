<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SetNullableColumnsOnProductLogs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_logs', function (Blueprint $table) {    
            $table->dropColumn('quantity');
            $table->dropColumn('total_sold');
        });

        Schema::table('product_logs', function (Blueprint $table) {
            $table->integer('quantity')->nullable()->after('product_id');
            $table->double('total_sold')->nullable()->after('quantity');
        });

        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('active');
        });

        Schema::table('products', function (Blueprint $table) {
            $table->boolean('active')->after('total_sold');
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
