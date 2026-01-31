<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;

class TransactionController extends Controller
{
    /**
     * List riwayat transaksi user
     */
    public function index()
    {
        $orders = Order::with(['items.course', 'payment'])
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('user.transactions.index', compact('orders'));
    }

    /**
     * Detail transaksi
     */
    public function show(Order $order)
    {
        abort_if($order->user_id !== auth()->id(), 403);

        $order->load(['items.course', 'payment']);

        return view('user.transactions.show', compact('order'));
    }

    /**
     * Generate invoice (PDF)
     */
    public function invoice(Order $order)
    {
        abort_if($order->user_id !== auth()->id(), 403);

        $order->load(['items.course', 'payment']);

        $pdf = Pdf::loadView('user.transactions.invoice', compact('order'));

        return $pdf->download(
            'Invoice-' . $order->id . '.pdf'
        );
    }
}
