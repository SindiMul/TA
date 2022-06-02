<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gallery extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'event_packages_id', 'image'
    ];

    protected $hidden = [

    ];

    public function event_package(){
        return $this->belongsTo( EventPackage::class, 'event_packages_id', 'id' );
    }


}
