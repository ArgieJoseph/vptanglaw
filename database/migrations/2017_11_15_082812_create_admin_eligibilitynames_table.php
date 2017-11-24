<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminEligibilitynamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_eligibilitynames', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('u_id');
            $table->integer('sem_id');
            $table->integer('sy_id');
            $table->integer('cs_pro')->default(0);
            $table->integer('cs_subpro')->default(0);
            $table->integer('testimonial')->default(0);
            $table->integer('tesda')->default(0);
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
        Schema::dropIfExists('admin_eligibilitynames');
    }
}
