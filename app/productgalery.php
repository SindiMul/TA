<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class productgalery extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'product_id', 'image'
    ];

    protected $hidden = [

    ];

    public function product(){
        return $this->belongsTo( product::class, 'product_id', 'id' );
    }
}
