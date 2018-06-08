<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnToLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasColumn('product_logs', 'sold_to') || 
            Schema::hasColumn('product_logs', 'from') || 
            Schema::hasColumn('product_logs', 'to')) {
            return;
        }
        Schema::table('product_logs', function(Blueprint $table) {
            $table->integer('sold_to')->unsigned()->after('sold_by');
            $table->date('from')->after('sold_to');
            $table->date('to')->after('from');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
