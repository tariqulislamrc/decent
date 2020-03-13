<?php

namespace App\models\Production;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function sub_category()
    {
        return $this->belongsTo(Category::class, 'sub_category_id', 'id');
    }

    public function material()
    {
        return $this->hasMany(ProductMaterial::class);
    }

    public function photo_details()
    {
        return $this->hasMany(ProductPhoto::class, 'product_id', 'id');
    }

    public function product_variation()
    {
        return $this->belongsTo(ProductVariation::class, 'id', 'product_id');
    }

    public function variation()
    {
        return $this->hasMany(Variation::class, 'product_id', 'id');
    }
}
