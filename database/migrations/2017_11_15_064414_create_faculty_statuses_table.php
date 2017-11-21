<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacultyStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faculty_statuses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('u_id');
            $table->integer('ft_male')->nullable();
            $table->integer('ft_female')->nullable();
            $table->integer('pt_male')->nullable();
            $table->integer('pt_female')->nullable();
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
        Schema::dropIfExists('faculty_statuses');
    }
}
