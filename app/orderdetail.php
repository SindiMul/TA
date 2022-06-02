<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class orderdetail extends Model
{

    protected $fillable = [
        'orders_id', 'username'
    ];

    protected $hidden = [

    ];
    public function order()
    {
        return $this->belongsTo(order::class, 'orders_id', 'id');
    }
}
