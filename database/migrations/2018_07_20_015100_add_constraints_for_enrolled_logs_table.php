<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddConstraintsForEnrolledLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('enrolled_logs', function (Blueprint $table) {
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
        Schema::table('enrolled_logs', function (Blueprint $table) {
            $table->dropForeign(['enrolled_id']);
        });
    }
}
