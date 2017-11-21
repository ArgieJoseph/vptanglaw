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
            $table->integer('single')->nullable();
            $table->integer('married')->nullable();
            $table->integer('widowed')->nullable();
            $table->integer('separated')->nullable();
            $table->integer('annulled')->nullable();
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
