<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateBuyersTransactionLogTransactionType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasColumn('buyers_transaction_logs', 'transaction_type')) {
            
            Schema::table('buyers_transaction_logs', function (Blueprint $table) {
                $table->dropColumn('transaction_type');
            });
        }
        
        Schema::table('buyers_transaction_logs', function (Blueprint $table) {
            $table->enum('transaction_type', ['buy', 'debt', 'pay']);
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
