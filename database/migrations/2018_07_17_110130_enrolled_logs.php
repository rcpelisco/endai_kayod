<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EnrolledLogs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enrolled_logs', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('enrolled_id')->unsigned();
            $table->double('amount_payed');

            $table->foreign('enrolled_id')->references('id')->on('enrolled');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
    }
}
