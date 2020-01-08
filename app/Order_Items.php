<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_Items extends Model
{
	use UsesUuid;
	
	protected $table = 'order_items';
	
    protected $fillable = [
      'user_id', 'order_id',  'name', 'price', 'quantity',
    ];
}
