<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class category extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'nama'
    ];

    protected $hidden = [

    ];
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }
}