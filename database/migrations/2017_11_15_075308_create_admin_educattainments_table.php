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
            $table->integer('sem_id');
            $table->integer('sy_id');
            $table->integer('elem_level')->default(0);
            $table->integer('elem_grad')->default(0);
            $table->integer('hs_level')->default(0);
            $table->integer('hs_grad')->default(0);
            $table->integer('vocational')->default(0);
            $table->integer('college_level')->default(0);
            $table->integer('college_grad')->default(0);
            $table->integer('masters')->default(0);
            $table->integer('phd')->default(0);
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
