<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacultySpecializationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faculty_specializations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('u_id');
            $table->integer('educ_science_teacher_training')->nullable();
            $table->integer('fine_arts')->nullable();
            $table->integer('humanities')->nullable();
            $table->integer('socialbehav_science')->nullable();
            $table->integer('busadm_related')->nullable();
            $table->integer('law_jurisprudence')->nullable();
            $table->integer('natural_science')->nullable();
            $table->integer('mathematics')->nullable();
            $table->integer('it_related')->nullable();
            $table->integer('medical_allied')->nullable();
            $table->integer('engineering_tech')->nullable();
            $table->integer('archi_townplanning')->nullable();
            $table->integer('agri_forestry')->nullable();
            $table->integer('service_trades')->nullable();
            $table->integer('masscomm_docu')->nullable();
            $table->integer('others')->nullable();
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
        Schema::dropIfExists('faculty_specializations');
    }
}
