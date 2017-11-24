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
            $table->integer('u_id');
            $table->integer('my_male')->default(0);
            $table->integer('my_female')->default(0);
            $table->integer('ye_male')->default(0);
            $table->integer('ye_female')->default(0);
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
