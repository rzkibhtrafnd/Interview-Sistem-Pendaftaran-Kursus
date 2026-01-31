<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\PaymentNotification;

class PaymentWebhookController extends Controller
{
    public function handle(Request $request)
    {
        $payment = Payment::where(
            'midtrans_order_id',
            $request->order_id
        )->firstOrFail();

        PaymentNotification::create([
            'payment_id' => $payment->id,
            'midtrans_order_id' => $request->order_id,
            'transaction_status' => $request->transaction_status,
            'fraud_status' => $request->fraud_status,
            'payload' => $request->all(),
            'received_at' => now(),
        ]);

        $payment->update([
            'transaction_id'     => $request->transaction_id,
            'payment_type'       => $request->payment_type,
            'transaction_status' => $request->transaction_status,
            'fraud_status'       => $request->fraud_status,
            'bank'               => $request->va_numbers[0]['bank'] ?? null,
            'va_number'          => $request->va_numbers[0]['va_number'] ?? null,
        ]);

        if (
            in_array($request->transaction_status, ['settlement', 'capture']) &&
            ($request->fraud_status ?? 'accept') === 'accept'
        ) {
            $payment->update([
                'status'  => 'PAID',
                'paid_at' => now(),
            ]);

            $payment->order->update([
                'status' => 'paid',
            ]);
        }

        return response()->json(['success' => true]);
    }

}

