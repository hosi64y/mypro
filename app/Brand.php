<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $upload='/storage/photos/';

    public function photo()
    {
        return $this->belongsTo(Photo::class);
    }

    public function getAttribute($photo)
    {
        return $this->upload.$photo;
    }
}
