<?php

namespace App\models\Production;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkOrderProduct extends Model
{
    use SoftDeletes;

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
