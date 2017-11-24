<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacilityRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facility_rooms', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('u_id');
            $table->integer('classroom')->default(0);
            $table->integer('administrative')->default(0);
            $table->integer('academic')->default(0);
            $table->integer('faculty_lounge')->default(0);
            $table->timestamps();
        });
        DB::statement('ALTER TABLE `facility_rooms` ADD `year` YEAR NOT NULL');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('facility_rooms');
    }
}
