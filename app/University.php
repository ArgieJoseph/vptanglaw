<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    //
         public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
