<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTFUniversitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_f_universities', function (Blueprint $table) {
            $table->increments('id');
                $table->integer('u_id');
                $table->integer('sy_id');
                $table->integer('sem_id');
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
        Schema::dropIfExists('t_f_universities');
    }
}
