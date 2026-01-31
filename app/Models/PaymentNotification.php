<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class PaymentNotification extends Model
{
    use HasUuids;

    protected $table = 'payment_notifications';

    protected $fillable = [
        'payment_id',
        'midtrans_order_id',
        'transaction_status',
        'fraud_status',
        'payload',
        'received_at',
    ];

    protected $casts = [
        'payload' => 'array',
        'received_at' => 'datetime',
    ];

    /**
     * Relasi ke payment
     */
    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
}
