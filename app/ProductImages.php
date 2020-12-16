<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductImages extends Model
{
	// use UsesUuid;
	
    protected $fillable = [
    	'product_id', 'imageUrl', 'thumbnail'
    ];

    public function product(){
    	return $this->belongsTo(Product::class);
    }
}
