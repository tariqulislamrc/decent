<?php

namespace App\models\depertment;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MaterialReport extends Model
{
    use SoftDeletes;

    // public function total_use_qty(){
    //   return $this->hasMany(MaterialReport::class,'done_material_report_id','id');
    // }
}
