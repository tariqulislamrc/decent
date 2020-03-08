<?php

namespace App\models\Production;

use Illuminate\Database\Eloquent\Model;

class VariationTemplate extends Model
{
    public function variation() {
        return $this->belongsTo(VariationTemplateDetails::class, 'variation_template_id', 'id');
    }
}
