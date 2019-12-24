<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = [
      'code', 'percent', 'expires_on'
    ];

    public static function findByCode($code)
    {
        return self::where('code', $code)->first();
    }

    // public static function discount($total)
    // {
    //     return round(($this->percent / 100) * $total);
    // }
}
