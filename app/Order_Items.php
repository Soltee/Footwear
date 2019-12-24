<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_Items extends Model
{
	protected $table = 'order_items';
	
    protected $fillable = [
      'order_id',  'name', 'price', 'quantity',
    ];
}
