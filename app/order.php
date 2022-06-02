<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    protected $fillable = [
        'product_id', 'users_id','departure_date',
        'transaction_total', 'transaction_status','tiket'
    ];
   

    public function order_details()
    {
        return $this->hasMany(orderdetail::class, 'order_id', 'id');
    }
    public function product()
    {
        return $this->belongsTo(product::class, 'product_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
