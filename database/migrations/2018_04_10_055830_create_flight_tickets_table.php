<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFlightTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('flight_tickets')) {
            return;
        }

        Schema::create('flight_tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('issue_date');
            $table->dateTime('booking_date');
            $table->string('booking_reference');
            $table->string('flight_number');
            $table->string('origin');
            $table->string('destination');
            $table->dateTime('departure_date');
            $table->dateTime('arrival_date');
            $table->string('passenger_name', 250);
            $table->string('ticket_number');
            $table->string('pax_type');
            $table->string('add_on_baggage');
            $table->decimal('total_amount', 8, 2);
            $table->integer('airline_company_id')->unsigned();
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
        Schema::dropIfExists('flight_tickets');
    }
}
