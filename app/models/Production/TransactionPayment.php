<?php

namespace App\models\Production;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransactionPayment extends Model
{
     protected $guarded = ['id'];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'transaction_id', 'id');
    }

    
    public function client()
    {
        return $this->belongsTo('App\models\Client');
    }
}
