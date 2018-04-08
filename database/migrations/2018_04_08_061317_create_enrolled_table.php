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
        if(Schema::hasTable('enrolled')) {
            return;
        }

        Schema::create('enrolled', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tutorial_id')->unsigned();
            $table->integer('student_id')->unsigned();
            $table->integer('sessions_left');
            $table->double('credit');
            $table->timestamps();

            $table->foreign('tutorial_id')->references('id')->on('tutorials');
            $table->foreign('student_id')->references('id')->on('students');
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
