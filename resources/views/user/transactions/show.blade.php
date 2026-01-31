<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Detail Transaksi
        </h2>
    </x-slot>

    <div class="max-w-4xl py-6 mx-auto">
        <div class="p-6 space-y-4 bg-white rounded-lg shadow">

            <div>
                <strong>Order ID:</strong> {{ $order->id }}
            </div>

            <div>
                <strong>Status:</strong>
                <span class="font-semibold">{{ strtoupper($order->status) }}</span>
            </div>

            <div>
                <strong>Total:</strong>
                Rp {{ number_format($order->total_amount,0,',','.') }}
            </div>

            <hr>

            <h3 class="font-semibold">Kursus</h3>
            <ul class="ml-6 list-disc">
                @foreach($order->items as $item)
                    <li>
                        {{ $item->course->title }}
                        — Rp {{ number_format($item->price,0,',','.') }}
                    </li>
                @endforeach
            </ul>

            @if($order->status === 'paid')
                <div class="pt-4">
                    <a href="{{ route('transactions.invoice', $order) }}"
                       class="inline-block px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">
                        Generate Invoice (PDF)
                    </a>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
