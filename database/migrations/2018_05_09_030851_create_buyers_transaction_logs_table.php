<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuyersTransactionLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buyers_transaction_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('buyer_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->enum('transaction_type', ['pay', 'buy']);
            $table->float('value');
            $table->timestamps();

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
        Schema::dropIfExists('buyers_transaction_logs');
    }
}
