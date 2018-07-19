<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddConstraintsForFlightTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('flight_tickets', function (Blueprint $table) {
            $table->foreign('airline_company_id')->references('id')->on('airline_companies');
            
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
            $table->dropForeign(['airline_company_id']);            
        });
    }
}
