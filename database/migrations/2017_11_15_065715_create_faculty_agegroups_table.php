<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacultyAgegroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faculty_agegroups', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('u_id');
            $table->integer('25-below')->nullable();
            $table->integer('26-31')->nullable();
            $table->integer('32-37')->nullable();
            $table->integer('38-43')->nullable();
            $table->integer('44-49')->nullable();
            $table->integer('50-55')->nullable();
            $table->integer('56-61')->nullable();
            $table->integer('62-67')->nullable();
            $table->integer('68-73')->nullable();
            $table->integer('74-79')->nullable();
            $table->integer('80-above')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('faculty_agegroups');
    }
}
