<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacilityLaboratoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facility_laboratories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('u_id');
            $table->integer('lab_name');
            $table->integer('room')->nullable();
            $table->string('capacity')->default(0);
            $table->timestamps();
        });

        DB::statement('ALTER TABLE `facility_laboratories` ADD `year` YEAR NOT NULL');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('facility_laboratories');
    }
}
