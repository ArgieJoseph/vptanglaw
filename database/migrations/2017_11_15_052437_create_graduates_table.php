<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGraduatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('graduates', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tu_id');
            $table->integer('male')->default(0);
            $table->integer('female')->default(0);
            $table->boolean('mid_end')->nullable();
            $table->timestamps();
        });
        DB::statement('ALTER TABLE `graduates` ADD `year` YEAR NOT NULL');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('graduates');
    }
}
