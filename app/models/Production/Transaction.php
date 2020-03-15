<?php

namespace App\models\Production;

use App\models\employee\Employee;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use SoftDeletes;
     protected $guarded = ['id'];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'purchase_by', 'id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }

    public function purchase()
    {
        return $this->hasMany(Purchase::class, 'transaction_id', 'id');
    }

    public function payment()
    {
        return $this->hasMany(TransactionPayment::class, 'transaction_id', 'id');
    }

    public function sell_lines()
    {
        return $this->hasMany('App\models\inventory\TransactionSellLine');
    }

    public function client()
    {
        return $this->belongsTo('App\models\Client');
    }

    public function created_person()
    {
        return $this->belongsTo('App\User', 'created_by');
    }

}
