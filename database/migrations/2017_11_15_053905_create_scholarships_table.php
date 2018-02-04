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
            $table->integer('ent_valid_male')->default(0);
            $table->integer('ent_valid_female')->default(0);
            $table->integer('ent_salut_male')->default(0);
            $table->integer('ent_salut_female')->default(0);
            $table->integer('ent_firsthon_male')->default(0);
            $table->integer('ent_firsthon_female')->default(0);
            $table->integer('ent_achiever_male')->default(0);
            $table->integer('ent_achiever_female')->default(0);
            $table->integer('ent_athlete_male')->default(0);
            $table->integer('ent_athlete_female')->default(0);
            $table->integer('ent_culturalart_male')->default(0);
            $table->integer('ent_culturalart_female')->default(0);
            $table->integer('ent_filmart_male')->default(0);
            $table->integer('ent_filmart_female')->default(0);
            $table->integer('ent_hsscpres_male')->default(0);
            $table->integer('ent_hsscpres_female')->default(0);
            $table->integer('resi_preslist_male')->default(0);
            $table->integer('resi_preslist_female')->default(0);
            $table->integer('resi_deanlist_male')->default(0);
            $table->integer('resi_deanlist_female')->default(0);
            $table->integer('sga_male')->default(0);
            $table->integer('sga_female')->default(0);
            $table->integer('fa_culturalgrp_male')->default(0);
            $table->integer('fa_culturalgrp_female')->default(0);
            $table->integer('fa_sc_male')->default(0);
            $table->integer('fa_sc_female')->default(0);
            $table->float('t_point')->default(0);
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
