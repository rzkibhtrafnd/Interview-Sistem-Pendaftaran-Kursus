<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Detail Transaksi
        </h2>
    </x-slot>

    <div class="max-w-5xl py-6 mx-auto">
        <div class="p-6 space-y-4 bg-white rounded-lg shadow">

            <div><strong>User:</strong> {{ $order->user->name }} ({{ $order->user->email }})</div>
            <div><strong>Order ID:</strong> {{ $order->id }}</div>
            <div><strong>Status Order:</strong> {{ strtoupper($order->status) }}</div>
            <div><strong>Total:</strong> Rp {{ number_format($order->total_amount,0,',','.') }}</div>

            <hr>

            <h3 class="font-semibold">Kursus</h3>
            <ul class="ml-6 list-disc">
                @foreach($order->items as $item)
                    <li>{{ $item->course->title }}</li>
                @endforeach
            </ul>

            <hr>

            <h3 class="font-semibold">Detail Pembayaran</h3>

            @if($order->payment)
                <table class="text-sm">
                    <tr>
                        <td class="pr-4">Metode</td>
                        <td>: {{ $order->payment->payment_type }}</td>
                    </tr>
                    <tr>
                        <td class="pr-4">Bank</td>
                        <td>: {{ $order->payment->bank ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="pr-4">VA</td>
                        <td>: {{ $order->payment->va_number ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="pr-4">Transaction ID</td>
                        <td>: {{ $order->payment->transaction_id ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="pr-4">Status Midtrans</td>
                        <td>: {{ $order->payment->transaction_status }}</td>
                    </tr>
                    <tr>
                        <td class="pr-4">Fraud Status</td>
                        <td>: {{ $order->payment->fraud_status }}</td>
                    </tr>
                </table>
            @else
                <p class="text-gray-500">Belum ada data pembayaran</p>
            @endif

        </div>
    </div>
</x-app-layout>
