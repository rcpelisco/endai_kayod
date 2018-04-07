<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTutorialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('tutorials')) {
            return;
        }

        Schema::create('tutorials', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 45);
            $table->string('description', 200);
            $table->double('price');
            $table->enum('type', ['academic', 'interest']);
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
        Schema::dropIfExists('tutorials');
    }
}
