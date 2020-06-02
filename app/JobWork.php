<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobWork extends Model
{
    use SoftDeletes;

   public function variation(){
        return $this->belongsTo('App\models\Production\Variation');
   }

   public function work_order(){
        return $this->belongsTo('App\models\Production\WorkOrder');
   }

   public function product(){
        return $this->belongsTo('App\models\Production\Product','product_id','id');
   }
}
