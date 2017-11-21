<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacultyAcadrankFtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faculty_acadrank_fts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('u_id');
            $table->integer('instructor')->nullable();
            $table->integer('asst_prof')->nullable();
            $table->integer('asso_prof')->nullable();
            $table->integer('professor')->nullable();
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
        Schema::dropIfExists('faculty_acadrank_fts');
    }
}
