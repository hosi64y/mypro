<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $uploads='/storage/photos/';

    public function photo()
    {
        return $this->belongsTo(Photo::class);
    }

    public function getPathAttribute($photo)
    {
        return $this->uploads.$photo;
    }
}
