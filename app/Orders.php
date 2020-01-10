<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use UsesUuid;
    
    protected $fillable = [
      'customer_id', 'first_name', 'last_name', 'email', 'phoneNumber', 'city', 'street_address', 'payment_method', 'payment_id', 'subtotal', 'discount', 'subafterdiscount', 'tax', 'grand'
    ];

    public function items(){
    	return $this->hasMany(Order_Items::class);
    }
}
