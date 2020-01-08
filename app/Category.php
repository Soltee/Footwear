<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use UsesUuid;
    protected $fillable = [
       'name',
    ];


    protected $hidden = [
        
    ];

    public function products()
    {
    	return $this->hasMany(Product::class);
    }

    public function subcategories()
    {
    	return $this->hasMany(Subcategory::class, 'category_id', 'id');
    }
  
}
