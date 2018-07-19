<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnrolledTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enrolled', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tutorial_id')->unsigned();
            $table->integer('student_id')->unsigned();
            $table->integer('sessions_left')->nullable();
            $table->double('credit');
            $table->boolean('active');
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
        Schema::dropIfExists('enrolled');
    }
}
