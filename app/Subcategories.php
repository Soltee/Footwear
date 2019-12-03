<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subcategories extends Model
{
    protected $fillable = [
      'category_id',  'name',
    ];

    protected $hidden = [
        
    ];

    public function products()
    {
    	return $this->belongsTo(Products::class);
    }
}
