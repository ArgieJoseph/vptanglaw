<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SchoolYear extends Model
{
    //
    protected $table = 'school_years';
    protected $fillable=['start_date', 'end_date'];
    protected $primaryKey='id';
    public $timestamps=true;

}
