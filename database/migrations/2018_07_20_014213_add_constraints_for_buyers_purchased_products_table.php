<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddConstraintsForBuyersPurchasedProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('buyers_purchased_products', function (Blueprint $table) {
            $table->foreign('buyer_id')->references('id')->on('buyers');
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('product_log_id')->references('id')->on('product_logs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('buyers_purchased_products', function (Blueprint $table) {
            $table->dropForeign(['buyer_id']);
            $table->dropForeign(['product_id']);
            $table->dropForeign(['product_log_id']);
        });
    }
}
