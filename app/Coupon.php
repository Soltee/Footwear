<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
	use UsesUuid;
    protected $fillable = [
      'code', 'percent', 'expires_on'
    ];

    public static function findByCode($code)
    {
        return self::where('code', $code)->first();
    }

  
}
