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
            $table->integer('sem_id');
            $table->integer('sy_id');
            $table->integer('instructor')->default(0);
            $table->integer('asst_prof')->default(0);
            $table->integer('asso_prof')->default(0);
            $table->integer('professor')->default(0);
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
