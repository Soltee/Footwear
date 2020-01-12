<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use UsesUuid;
    protected $fillable = [
       'name', 'slug'
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

    public static function boot() {
        parent::boot();

        static::deleting(function($category) { 
        // before delete() method call this
             $category->subcategories()->delete();
             // do the rest of the cleanup...
        });
    }
  
}
