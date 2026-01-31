<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Riwayat Transaksi
        </h2>
    </x-slot>

    <div class="py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="p-6 bg-white rounded-lg shadow">

            <table class="w-full text-sm border">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-3 text-left">Tanggal</th>
                        <th class="p-3 text-left">Order ID</th>
                        <th class="p-3 text-left">Total</th>
                        <th class="p-3 text-left">Status</th>
                        <th class="p-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        <tr class="border-t">
                            <td class="p-3">
                                {{ $order->created_at->format('d M Y') }}
                            </td>
                            <td class="p-3">
                                {{ $order->id }}
                            </td>
                            <td class="p-3">
                                Rp {{ number_format($order->total_amount,0,',','.') }}
                            </td>
                            <td class="p-3">
                                <span class="px-2 py-1 rounded text-xs
                                    {{ $order->status === 'paid' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                    {{ strtoupper($order->status) }}
                                </span>
                            </td>
                            <td class="p-3 text-right">
                                <a href="{{ route('transactions.show', $order) }}"
                                   class="text-blue-600 hover:underline">
                                    Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-4 text-center text-gray-500">
                                Belum ada transaksi
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-4">
                {{ $orders->links() }}
            </div>

        </div>
    </div>
</x-app-layout>
