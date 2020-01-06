<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductImages extends Model
{
    protected $fillable = [
    	'products_id', 'imageUrl', 'thumbnail'
    ];

    public function product(){
    	return $this->belongsTo(Products::class);
    }
}
