<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacilityBuildingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facility_buildings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('u_id');
            $table->string('building_name');
            $table->float('area')->default(0);
            $table->timestamps();
        });
         DB::statement('ALTER TABLE `facility_buildings` ADD `year` YEAR NOT NULL');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('facility_buildings');
    }
}
