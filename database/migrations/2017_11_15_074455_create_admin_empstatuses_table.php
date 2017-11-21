<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminEmpstatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_empstatuses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('u_id');
            $table->integer('casual_male')->nullable();
            $table->integer('casual_female')->nullable();
            $table->integer('permanent_male')->nullable();
            $table->integer('permanent_female')->nullable();
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
        Schema::dropIfExists('admin_empstatuses');
    }
}
