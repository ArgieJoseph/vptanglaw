<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminServiceyrsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_serviceyrs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('u_id');
            $table->integer('sem_id');
            $table->integer('sy_id');
            $table->integer('below1')->default(0);
            $table->integer('1-5')->default(0);
            $table->integer('6-10')->default(0);
            $table->integer('11-15')->default(0);
            $table->integer('16-20')->default(0);
            $table->integer('21-25')->default(0);
            $table->integer('26-30')->default(0);
            $table->integer('31-35')->default(0);
            $table->integer('36-above')->default(0);
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
        Schema::dropIfExists('admin_serviceyrs');
    }
}
