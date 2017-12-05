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
            $table->integer('sem_id');
            $table->integer('sy_id');
            $table->integer('educ_science_teacher_training')->default(0);
            $table->integer('fine_arts')->default(0);
            $table->integer('humanities')->default(0);
            $table->integer('socialbehav_science')->default(0);
            $table->integer('busadm_related')->default(0);
            $table->integer('law_jurisprudence')->default(0);
            $table->integer('natural_science')->default(0);
            $table->integer('mathematics')->default(0);
            $table->integer('it_related')->default(0);
            $table->integer('medical_allied')->default(0);
            $table->integer('engineering_tech')->default(0);
            $table->integer('archi_townplanning')->default(0);
            $table->integer('agri_forestry')->default(0);
            $table->integer('service_trades')->default(0);
            $table->integer('masscomm_docu')->default(0);
            $table->integer('others')->default(0);
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
