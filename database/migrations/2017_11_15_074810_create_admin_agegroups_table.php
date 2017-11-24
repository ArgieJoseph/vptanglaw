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
            $table->integer('sem_id');
            $table->integer('sy_id');
            $table->integer('25-below')->default(0);
            $table->integer('26-30')->default(0);
            $table->integer('31-35')->default(0);
            $table->integer('36-40')->default(0);
            $table->integer('41-45')->default(0);
            $table->integer('46-50')->default(0);
            $table->integer('51-55')->default(0);
            $table->integer('56-60')->default(0);
            $table->integer('61-above')->default(0);
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
