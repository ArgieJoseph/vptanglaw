<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminServicegrpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_servicegrps', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('u_id');
            $table->integer('gen_admin')->nullable();
            $table->integer('planning')->nullable();
            $table->integer('med_health')->nullable();
            $table->integer('educ_archival')->nullable();
            $table->integer('defense_security')->nullable();
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
        Schema::dropIfExists('admin_servicegrps');
    }
}
