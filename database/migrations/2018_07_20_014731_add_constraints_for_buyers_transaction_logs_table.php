<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddConstraintsForBuyersTransactionLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('buyers_transaction_logs', function (Blueprint $table) {
            $table->foreign('buyer_id')->references('id')->on('buyers');
            $table->foreign('product_id')->references('id')->on('products');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('buyers_transaction_logs', function (Blueprint $table) {
            $table->dropForeign(['buyer_id']);
            $table->dropForeign(['product_id']);
        });
    }
}
