<?php

namespace App\models\depertment;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductFlow extends Model
{
     use SoftDeletes;

   public function variation(){
        return $this->belongsTo('App\models\production\Variation');
   }
}
