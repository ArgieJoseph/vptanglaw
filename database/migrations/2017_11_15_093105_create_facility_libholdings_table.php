<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacilityLibholdingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facility_libholdings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('u_id');
            $table->integer('textbook')->default(0);
            $table->integer('periodical')->default(0);
            $table->integer('cd')->default(0);
            $table->string('others')->default(0);
            $table->timestamps();
        });
          DB::statement('ALTER TABLE `facility_libholdings` ADD `year` YEAR NOT NULL');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('facility_libholdings');
    }
}
