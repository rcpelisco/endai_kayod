<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddConstraintsForEnrolledTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('enrolled', function (Blueprint $table) {
            $table->foreign('student_id')->references('id')->on('students');
            $table->foreign('tutorial_id')->references('id')->on('tutorials');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('enrolled', function (Blueprint $table) {
            $table->dropForeign(['student_id']);
            $table->dropForeign(['tutorial_id']);
        });
    }
}
