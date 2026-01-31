<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TransactionExport implements FromArray, WithHeadings
{
    public function headings(): array
    {
        return [
            'Tanggal',
            'User',
            'Email',
            'Order ID',
            'Kursus',
            'Total',
            'Status Order',
            'Metode Pembayaran',
            'Status Pembayaran'
        ];
    }

    public function array(): array
    {
        return Order::with(['user','payment','items.course'])
            ->latest()
            ->get()
            ->map(function ($order) {
                return [
                    $order->created_at->format('Y-m-d'),
                    $order->user->name,
                    $order->user->email,
                    $order->id,
                    optional($order->items->first()->course)->title,
                    $order->total_amount,
                    strtoupper($order->status),
                    $order->payment->payment_type ?? '-',
                    $order->payment->transaction_status ?? '-',
                ];
            })->toArray();
    }
}
