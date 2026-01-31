<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TransactionExport;

class TransactionController extends Controller
{
    /**
     * List semua transaksi
     */
    public function index()
    {
        $orders = Order::with(['user', 'payment'])
            ->latest()
            ->paginate(15);

        return view('admin.transactions.index', compact('orders'));
    }

    /**
     * Detail transaksi
     */
    public function show(Order $order)
    {
        $order->load(['user', 'items.course', 'payment']);

        return view('admin.transactions.show', compact('order'));
    }

    /**
     * Export PDF semua transaksi
     */
    public function exportPdf()
    {
        $orders = Order::with(['user','payment','items.course'])
            ->latest()
            ->get();

        $pdf = Pdf::loadView(
            'admin.transactions.pdf',
            compact('orders')
        );

        return $pdf->download('Laporan-Transaksi.pdf');
    }

    /**
     * Export Excel semua transaksi
     */
    public function exportExcel()
    {
        return Excel::download(
            new TransactionExport,
            'Laporan-Transaksi.xlsx'
        );
    }
}
