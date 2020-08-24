<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use UsesUuid;

    protected $fillable = [
      'customer_id', 'product_id', 'rating', 'message'
    ];

    protected $hidden = [
        
    ];

    public function product()
    {
    	return $this->belongsTo(Product::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
