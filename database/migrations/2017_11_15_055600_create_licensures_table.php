<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLicensuresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('licensures', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('u_id');
            $table->string('exam_name');
            $table->string('month');
            $table->integer('natl_passer')->nullable();
            $table->integer('natl_examinee')->nullable();
            $table->integer('pup_passer')->nullable();
            $table->integer('pup_examinee')->nullable();
            $table->string('placer')->nullable();
            $table->timestamps();
        });

        DB::statement('ALTER TABLE `licensures` ADD `year` YEAR NOT NULL');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('licensures');
    }
}
