<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: DejaVu Sans; font-size: 11px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 6px; }
        th { background: #f0f0f0; }
    </style>
</head>
<body>

<h3>Laporan Transaksi</h3>
<p>Tanggal Cetak: {{ now()->format('d M Y') }}</p>

<table>
    <thead>
        <tr>
            <th>Tanggal</th>
            <th>User</th>
            <th>Order</th>
            <th>Kursus</th>
            <th>Total</th>
            <th>Status</th>
            <th>Metode</th>
        </tr>
    </thead>
    <tbody>
        @foreach($orders as $order)
        <tr>
            <td>{{ $order->created_at->format('d-m-Y') }}</td>
            <td>{{ $order->user->name }}</td>
            <td>{{ $order->id }}</td>
            <td>{{ optional($order->items->first()->course)->title }}</td>
            <td>{{ $order->total_amount }}</td>
            <td>{{ strtoupper($order->status) }}</td>
            <td>{{ $order->payment->payment_type ?? '-' }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
