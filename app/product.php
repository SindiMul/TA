<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class product extends Model
{
    use SoftDeletes;
    protected $fillable = [
    'title', 'slug', 'location', 'about', 'price', 'kuota', 'category_id'
    ];

    protected $hidden = [

    ];
    
    
    public function productgalery(){
        return $this->hasMany( productgalery::class, 'product_id', 'id' );
    }
    
    public function category()
    {
        return $this->belongsTo(category::class, 'category_id', 'id');
    }
    public function order()
    {
        return $this->hasMany(order::class, 'product_id', 'id');
    }
    public function pesanan_details()
    {
        return $this->hasMany(PesananDetail::class, 'product_id', 'id');
    }
}
