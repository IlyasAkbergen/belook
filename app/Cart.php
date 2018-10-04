<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'buyer_id', 'good_id', 'price',
    ];

    public function good()
    {
        return $this->belongsTo('App\Good', 'good_id');
    }
}
