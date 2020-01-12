<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_Items extends Model
{
	use UsesUuid;
	
	protected $table = 'order_items';
	
    protected $fillable = [
      'customer_id', 'orders_id',  'name', 'price', 'quantity',
    ];

    public function customer(){
    	return $this->belongsTo(Customer::class);
    }

    public function order(){
    	return $this->belongsTo(Orders::class);
    }
}
