<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    
    protected $fillable = [
      'user_id', 'first_name', 'last_name', 'email', 'phoneNumber', 'city', 'street_address', 'payment_method', 'subtotal', 'discount', 'subafterdiscount', 'tax', 'grand'
    ];
}
