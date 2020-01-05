<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $fillable = [
      'category_id', 'subcategory_id', 'imageUrl', 'name', 'price', 'qty', 'excerpt', 'description', 'visible',
    ];


    protected $hidden = [
        
    ];

    public function category()
    {
    	return $this->belongsTo(Categories::class);
    }

    public function subcategory()
    {
    	return $this->belongsTo(Subcategories::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImages::class);
    }

    public function scopeFindByCategorySlug($query, $slug)
    {
        return $query->whereHas('category', function ($query) use ($slug) {
            $query->where('name', $slug);
        });
    }

    public function scopeFindBySubcategorySlug($query, $slug)
    {
        return $query->whereHas('subcategory', function ($query) use ($slug) {
            $query->where('name', $slug);
        });
    }
}
