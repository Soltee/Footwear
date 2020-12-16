<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    // use UsesUuid;
    
    protected $fillable = [
      'category_id',  'name', 'slug'
    ];

    protected $hidden = [
        
    ];

    public function products()
    {
    	return $this->belongsTo(Product::class);
    }

    public function category()
    {
    	return $this->belongsTo(Category::class);
    }
}
