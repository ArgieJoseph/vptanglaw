<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacultyAcadrankPtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faculty_acadrank_pts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('u_id');
            $table->integer('instructor')->nullable();
            $table->integer('lecturer')->nullable();
            $table->integer('asst_lectr')->nullable();
            $table->integer('asso_lectr')->nullable();
            $table->integer('prof_lectr')->nullable();
            $table->integer('univprov_lectr')->nullable();
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
        Schema::dropIfExists('faculty_acadrank_pts');
    }
}
