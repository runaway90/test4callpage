<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkingList extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('working_list', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('employer_id');
            $table->date('date');
            $table->string('work_from');
            $table->string('work_to');
            $table->bigInteger('minutes_per_day')->nullable();

            $table->timestampsTz();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('working_list');
    }
}
