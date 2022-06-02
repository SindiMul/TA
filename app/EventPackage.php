<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventPackage extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title', 'slug', 'location', 'about', 'featured_event',
        'foods','duration',
        'type', 'price'
    ];

    protected $hidden = [

    ];

    public function galleries(){
        return $this->hasMany( Gallery::class, 'event_packages_id', 'id' );
    }

}
