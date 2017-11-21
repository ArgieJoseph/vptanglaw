<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminEducattainmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_educattainments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('u_id');
            $table->integer('elem_level')->nullable();
            $table->integer('elem_grad')->nullable();
            $table->integer('hs_level')->nullable();
            $table->integer('hs_grad')->nullable();
            $table->integer('vocational')->nullable();
            $table->integer('college_level')->nullable();
            $table->integer('college_grad')->nullable();
            $table->integer('masters')->nullable();
            $table->integer('phd')->nullable();
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
        Schema::dropIfExists('admin_educattainments');
    }
}
