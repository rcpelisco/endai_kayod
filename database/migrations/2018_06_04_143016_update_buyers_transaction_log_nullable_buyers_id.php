<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateBuyersTransactionLogNullableBuyersId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('buyers_transaction_logs', function(Blueprint $table) {
            $table->dropForeign(['buyer_id']);
            $table->dropColumn('buyer_id');
        });

        Schema::table('buyers_transaction_logs', function(Blueprint $table) {
            $table->integer('buyer_id')->unsigned()->nullable();
            $table->foreign('buyer_id')->references('id')->on('buyers');
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
