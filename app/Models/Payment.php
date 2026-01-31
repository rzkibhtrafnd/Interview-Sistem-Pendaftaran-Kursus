<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Payment extends Model
{
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'order_id',
        'user_id',
        'midtrans_order_id',

        'transaction_id',
        'payment_type',
        'bank',
        'va_number',

        'gross_amount',
        'currency',

        'transaction_status',
        'fraud_status',

        'status',
        'snap_token',
        'snap_redirect_url',

        'paid_at',
        'expired_at',
    ];

    protected $casts = [
        'paid_at' => 'datetime',
        'expired_at' => 'datetime',
    ];

    protected static function booted()
    {
        static::creating(function ($model) {
            if (! $model->getKey()) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
