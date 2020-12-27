<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    // use UsesUuid;
    
    protected $fillable = [
      'customer_id', 'first_name', 'last_name', 'email', 'phoneNumber', 'city', 'street_address', 'payment_method', 'payment_id', 'subtotal', 'discount', 'subafterdiscount', 'tax', 'grand', 'completed'
    ];

    public function customer(){
    	return $this->belongsTo(Customer::class);
    }

    public function items(){
    	return $this->hasMany(Order_Item::class);
    }
}
