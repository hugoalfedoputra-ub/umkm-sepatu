<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'session_token'];

    public function items()
    {
        return $this->hasMany(CartItem::class);
    }

    public static function findOrCreateBySessionToken($token)
    {
        $cart = self::firstOrCreate(['session_token' => $token]);
        return $cart;
    }
}
