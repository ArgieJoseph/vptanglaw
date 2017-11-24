<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacultyProgramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faculty_programs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('u_id');
            $table->integer('sem_id');
            $table->integer('sy_id');
            $table->string('classification');
            $table->integer('beneficiary')->default(0);
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
        Schema::dropIfExists('faculty_programs');
    }
}
