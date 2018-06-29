<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDebtPayType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_logs', function (Blueprint $table) {
            $table->dropColumn('type');
        });
        
        Schema::table('product_logs', function (Blueprint $table) {
            $table->enum('type', ['add_stock','buy', 'edit', 'delete', 'debt', 'pay']);
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
