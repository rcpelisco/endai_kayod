<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductEditHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('product_edit_histories')) {
            return;
        }
        Schema::create('product_edit_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('product_name');
            $table->string('description');
            $table->integer('quantity');
            $table->integer('price');
            $table->integer('product_log_id')->unsigned();
            $table->integer('edited_by')->unsigned();
            $table->timestamps();
            
            $table->foreign('edited_by')->references('id')->on('users');
            $table->foreign('product_log_id')->references('id')->on('product_log');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_edit_histories');
    }
}
