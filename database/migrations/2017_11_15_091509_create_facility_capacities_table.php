<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacilityCapacitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facility_capacities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('u_id');
            $table->string('facility_name');
            $table->string('capacity')->default(0);
            $table->timestamps();
        });
         DB::statement('ALTER TABLE `facility_capacities` ADD `year` YEAR NOT NULL');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('facility_capacities');
    }
}
