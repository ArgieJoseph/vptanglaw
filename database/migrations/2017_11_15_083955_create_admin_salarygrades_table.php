<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminSalarygradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_salarygrades', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('u_id');
            $table->integer('1-5')->nullable();
            $table->integer('6-10')->nullable();
            $table->integer('11-15')->nullable();
            $table->integer('16-20')->nullable();
            $table->integer('21-25')->nullable();
            $table->integer('26-30')->nullable();
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
        Schema::dropIfExists('admin_salarygrades');
    }
}
