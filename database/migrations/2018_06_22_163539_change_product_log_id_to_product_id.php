<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeProductLogIdToProductId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasColumn('product_edit_histories', 'product_log_id')) {
            Schema::table('product_edit_histories', function (Blueprint $table) {    
                $table->dropColumn('product_log_id');
            });
        }

        Schema::table('product_edit_histories', function (Blueprint $table) {    
            $table->integer('product_id')->unsigned()->after('price');
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
