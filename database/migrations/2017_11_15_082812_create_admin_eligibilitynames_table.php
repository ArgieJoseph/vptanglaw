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
            $table->integer('cs_pro')->nullable();
            $table->integer('cs_subpro')->nullable();
            $table->integer('testimonial')->nullable();
            $table->integer('tesda')->nullable();
            $table->integer('others')->nullable();
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
