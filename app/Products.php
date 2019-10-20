<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $fillable = [
      'category_id', 'imageUrl', 'name', 'price', 'qty', 'excerpt', 'description', 'visible',
    ];


    protected $hidden = [
        
    ];

    public function category()
    {
    	return $this->belongsTo(Categories::class);
    }
}
