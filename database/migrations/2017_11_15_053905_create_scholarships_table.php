<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScholarshipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scholarships', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tu_id');
            $table->integer('ent_valid_male')->nullable();
            $table->integer('ent_valid_female')->nullable();
            $table->integer('ent_salut_male')->nullable();
            $table->integer('ent_salut_female')->nullable();
            $table->integer('ent_firsthon_male')->nullable();
            $table->integer('ent_firsthon_female')->nullable();
            $table->integer('ent_achiever_male')->nullable();
            $table->integer('ent_achiever_female')->nullable();
            $table->integer('ent_athlete_male')->nullable();
            $table->integer('ent_athlete_female')->nullable();
            $table->integer('ent_culturalart_male')->nullable();
            $table->integer('ent_culturalart_female')->nullable();
            $table->integer('ent_filmart_male')->nullable();
            $table->integer('ent_filmart_female')->nullable();
            $table->integer('ent_hsscpres_male')->nullable();
            $table->integer('ent_hsscpres_female')->nullable();
            $table->integer('resi_preslist_male')->nullable();
            $table->integer('resi_preslist_female')->nullable();
            $table->integer('resi_deanlist_male')->nullable();
            $table->integer('resi_deanlist_female')->nullable();
            $table->integer('sga_male')->nullable();
            $table->integer('sga_female')->nullable();
            $table->integer('fa_culturalgrp_male')->nullable();
            $table->integer('fa_culturalgrp_female')->nullable();
            $table->integer('fa_sc_male')->nullable();
            $table->integer('fa_sc_female')->nullable();
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
        Schema::dropIfExists('scholarships');
    }
}
