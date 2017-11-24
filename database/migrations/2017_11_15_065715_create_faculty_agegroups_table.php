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
            $table->integer('sem_id');
            $table->integer('sy_id');
            $table->integer('25-below')->default(0);
            $table->integer('26-31')->default(0);
            $table->integer('32-37')->default(0);
            $table->integer('38-43')->default(0);
            $table->integer('44-49')->default(0);
            $table->integer('50-55')->default(0);
            $table->integer('56-61')->default(0);
            $table->integer('62-67')->default(0);
            $table->integer('68-73')->default(0);
            $table->integer('74-79')->default(0);
            $table->integer('80-above')->default(0);
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
