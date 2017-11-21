<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacultyWorkloadunitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faculty_workloadunits', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('u_id');
            $table->integer('6-below')->nullable();
            $table->integer('7-12')->nullable();
            $table->integer('13-18')->nullable();
            $table->integer('19-24')->nullable();
            $table->integer('25-30')->nullable();
            $table->integer('31-36')->nullable();
            $table->integer('37-42')->nullable();
            $table->integer('43-above')->nullable();
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
        Schema::dropIfExists('faculty_workloadunits');
    }
}
