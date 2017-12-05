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
            $table->integer('sem_id');
            $table->integer('sy_id');
            $table->integer('lecturer')->default(0);
            $table->integer('instructor')->default(0);
            $table->integer('asst_lectr')->default(0);
            $table->integer('asso_lectr')->default(0);
            $table->integer('prof_lectr')->default(0);  
            $table->integer('univprov_lectr')->default(0);
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
