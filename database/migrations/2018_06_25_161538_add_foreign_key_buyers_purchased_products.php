<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyBuyersPurchasedProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('buyers_purchased_products', function (Blueprint $table) {  
            if(!Schema::hasColumn('buyers_purchased_products', 'product_log_id')) {
                $table->integer('product_log_id')->unsigned()->after('product_id');
            }
            
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
        //
    }
}
