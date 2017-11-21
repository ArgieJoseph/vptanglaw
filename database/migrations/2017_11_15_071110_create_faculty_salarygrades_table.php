<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacultySalarygradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faculty_salarygrades', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('u_id');
            $table->integer('12-14')->nullable();
            $table->integer('15-18')->nullable();
            $table->integer('19-23')->nullable();
            $table->integer('24-30')->nullable();
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
        Schema::dropIfExists('faculty_salarygrades');
    }
}
