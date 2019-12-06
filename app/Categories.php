<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $fillable = [
       'name',
    ];


    protected $hidden = [
        
    ];

    public function products()
    {
    	return $this->hasMany(Products::class);
    }

    public function subcategories()
    {
    	return $this->hasMany(Subcategories::class, 'category_id', 'id');
    }
  
}
