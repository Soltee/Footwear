<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use UsesUuid;
    protected $fillable = [
      'category_id', 'subcategory_id', 'imageUrl', 'name', 'slug', 'price', 'qty', 'excerpt', 'description', 'visible',
    ];


    protected $hidden = [
        
    ];

    public function categories()
    {
    	return $this->belongsTo(Category::class);
    }

    public function subcategories()
    {
    	return $this->belongsTo(Subcategory::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImages::class);
    }

    public static function boot() {
        parent::boot();

        static::deleting(function($product) { 
        // before delete() method call this
             $product->images()->delete();
             // do the rest of the cleanup...
        });
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
