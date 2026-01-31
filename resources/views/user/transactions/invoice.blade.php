<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice</title>
    <style>
        body { font-family: DejaVu Sans; font-size: 12px; }
        table { width:100%; border-collapse: collapse; }
        th, td { border:1px solid #000; padding:6px; }
    </style>
</head>
<body>

<h2>INVOICE</h2>

<p>
    <strong>Order ID:</strong> {{ $order->id }}<br>
    <strong>Tanggal:</strong> {{ $order->created_at->format('d M Y') }}<br>
    <strong>Pembeli:</strong> {{ $order->user->name }}
</p>

<table>
    <thead>
        <tr>
            <th>Kursus</th>
            <th>Harga</th>
        </tr>
    </thead>
    <tbody>
        @foreach($order->items as $item)
            <tr>
                <td>{{ $item->course->title }}</td>
                <td>Rp {{ number_format($item->price,0,',','.') }}</td>
            </tr>
        @endforeach
        <tr>
            <td><strong>Total</strong></td>
            <td><strong>Rp {{ number_format($order->total_amount,0,',','.') }}</strong></td>
        </tr>
    </tbody>
</table>

<p style="margin-top:20px;">
    Status Pembayaran: <strong>{{ strtoupper($order->status) }}</strong>
</p>

</body>
</html>
