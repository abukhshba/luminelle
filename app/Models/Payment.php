<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = ['order_id','user_id', 'amount','remain', 'payment_method'];

    protected $casts = [
        'amount' => 'float'
    ];

    protected $attributes = [
        'payment_method' => 'فودافون كاش'
    ];

    protected $enumPaymentMethods = ['فورى', 'فودافون كاش', 'بطاقة ائتمان'];

    public static function getPaymentMethods(): array
    {
        return self::$enumPaymentMethods;
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
