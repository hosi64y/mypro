<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function children()
    {
        return $this->hasMany(Category::class,'parent_id');
    }

    public function childrenRecorsive()
    {
        return $this->children()->with('childrenRecorsive');
    }

    public function products(){
        return $this->hasMany(Product::class);
    }

    public function attributeGroups()
    {
        return $this->belongsToMany(AttributeGroup::class,'attributegroup_category','category_id','attributeGroup_id');
    }

}
