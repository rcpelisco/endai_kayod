<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddConstraintsForSecondFlightIdFlightTikcetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('flight_tickets', function (Blueprint $table) {
            $table->foreign('primary_ticket_id')
                ->references('id')->on('flight_tickets')
                ->onDelete('cascade')->after('pnr');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('flight_tickets', function (Blueprint $table) {
            $table->dropForeign(['primary_ticket_id']);
        });
    }
}
