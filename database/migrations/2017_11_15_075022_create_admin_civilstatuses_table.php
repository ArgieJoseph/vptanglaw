<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminCivilstatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_civilstatuses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('u_id');
            $table->integer('sem_id');
            $table->integer('sy_id');
            $table->integer('single')->default(0);
            $table->integer('married')->default(0);
            $table->integer('widowed')->default(0);
            $table->integer('separated')->default(0);
            $table->integer('annulled')->default(0);
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
        Schema::dropIfExists('admin_civilstatuses');
    }
}
