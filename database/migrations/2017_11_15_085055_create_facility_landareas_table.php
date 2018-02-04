<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacilityLandareasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facility_landareas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('u_id');
            $table->float('land_area')->nullable();
            $table->float('t_point')->default(0);
            $table->timestamps();
        });
         DB::statement('ALTER TABLE `facility_landareas` ADD `year` YEAR NOT NULL');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('facility_landareas');
    }
}
