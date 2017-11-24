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
            $table->integer('sem_id');
            $table->integer('sy_id');
            $table->integer('6-below')->default(0);
            $table->integer('7-12')->default(0);
            $table->integer('13-18')->default(0);
            $table->integer('19-24')->default(0);
            $table->integer('25-30')->default(0);
            $table->integer('31-36')->default(0);
            $table->integer('37-42')->default(0);
            $table->integer('43-above')->default(0);
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
