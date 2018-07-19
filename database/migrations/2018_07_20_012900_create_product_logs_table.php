<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->unsigned();
            $table->integer('sold_by')->unsigned();
            $table->integer('sold_to')->unsigned()->nullable();
            $table->integer('quantity')->nullable();
            $table->double('total_sold')->nullable();
            $table->enum('type', ['add_stock','buy','edit','delete','debt','pay']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_logs');
    }
}
