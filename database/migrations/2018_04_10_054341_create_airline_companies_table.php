<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAirlineCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('airline_companies')) {
            return;
        }
        Schema::create('airline_companies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('address', 250);
            $table->string('phone_number');
            $table->string('email');
            $table->string('logo_path');
            $table->string('pnr');
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
        Schema::dropIfExists('airline_companies');
    }
}
