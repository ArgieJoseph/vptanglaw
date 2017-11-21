<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTUniversitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_universities', function (Blueprint $table) {
            $table->increments('id');
                $table->integer('sy_id');
                $table->integer('sem_id');
                $table->integer('u_id');
                $table->string('education');
                $table->string('course');
                $table->string('major');
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
        Schema::dropIfExists('t_universities');
    }
}
