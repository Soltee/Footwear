<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_Item extends Model
{
	// use UsesUuid;
	
	protected $table = 'order_items';
	
    protected $fillable = [
      'customer_id', 'order_id', 'product_id', 'name', 'price', 'quantity',
    ];

    public function customer(){
    	return $this->belongsTo(Customer::class);
    }

    public function order(){
    	return $this->belongsTo(Order::class);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
