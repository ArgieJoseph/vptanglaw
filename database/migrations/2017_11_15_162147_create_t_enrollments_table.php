<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTEnrollmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_enrollments', function (Blueprint $table) {
            $table->integer('id');
                $table->integer('tu_id');
                $table->integer('1stmale')->nullable();
                $table->integer('1stfemale')->nullable();
                $table->integer('2ndmale')->nullable();
                $table->integer('2ndfemale')->nullable();
                $table->integer('3rdmale')->nullable();
                $table->integer('3rdfemale')->nullable();
                $table->integer('4thmale')->nullable();
                $table->integer('4thfemale')->nullable();
                $table->integer('5thmale')->nullable();
                $table->integer('5thfemale')->nullable();
                $table->float('t_point')->default(0);
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
        Schema::dropIfExists('t_enrollments');
    }
}
