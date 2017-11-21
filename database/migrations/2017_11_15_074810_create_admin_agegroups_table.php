<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminAgegroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_agegroups', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('u_id');
            $table->integer('25-below')->nullable();
            $table->integer('26-30')->nullable();
            $table->integer('31-35')->nullable();
            $table->integer('36-40')->nullable();
            $table->integer('41-45')->nullable();
            $table->integer('46-50')->nullable();
            $table->integer('51-55')->nullable();
            $table->integer('56-60')->nullable();
            $table->integer('61-above')->nullable();
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
        Schema::dropIfExists('admin_agegroups');
    }
}
