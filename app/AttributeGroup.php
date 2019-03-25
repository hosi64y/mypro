<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttributeGroup extends Model
{
    protected $table='attributesgroup';

//    public function AttributeValue()
//    {
//        return $this->hasMany(AttributeValue::class);
//    }
    public function category()
    {
        return $this->belongsToMany(Category::class,'attributegroup_category','atttibuteGroup_id','category_id');

    }
}
