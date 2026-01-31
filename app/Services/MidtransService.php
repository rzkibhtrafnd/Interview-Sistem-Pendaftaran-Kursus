<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Payment;
use Midtrans\Snap;

class MidtransService
{
    public function createSnap(Order $order): Payment
    {
        $midtransOrderId = 'ORDER-' . $order->id;

        $params = [
            'transaction_details' => [
                'order_id' => $midtransOrderId,
                'gross_amount' => $order->total_amount,
            ],
            'customer_details' => [
                'email' => $order->user->email,
                'first_name' => $order->user->name,
            ],
        ];

        $snap = Snap::createTransaction($params);

        return Payment::create([
            'order_id' => $order->id,
            'user_id' => $order->user_id,
            'midtrans_order_id' => $midtransOrderId,
            'gross_amount' => $order->total_amount,
            'status' => 'PENDING',
            'snap_token' => $snap->token,
            'snap_redirect_url' => $snap->redirect_url,
        ]);
    }
}

