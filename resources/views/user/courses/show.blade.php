<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ $course->title }}
        </h2>
    </x-slot>

    <div class="max-w-5xl py-6 mx-auto sm:px-6 lg:px-8">
        <div class="p-6 bg-white rounded-lg shadow-md">

            {{-- Info utama --}}
            <div class="mb-6">
                <span class="inline-block px-3 py-1 text-sm text-blue-700 bg-blue-100 rounded">
                    {{ $course->category->name }}
                </span>

                <p class="mt-4 text-gray-700">
                    {{ $course->description }}
                </p>

                <div class="mt-4 text-lg font-semibold text-blue-600">
                    Rp {{ number_format($course->price, 0, ',', '.') }}
                </div>
            </div>

            {{-- Materi --}}
            <div class="mt-8">
                <h3 class="mb-4 text-lg font-semibold text-gray-800">
                    Daftar Materi
                </h3>

                <ul class="space-y-3">
                    @forelse($course->materials as $material)
                        <li class="flex items-center p-3 border rounded-md">
                            <span class="flex items-center justify-center w-8 h-8 mr-3 text-sm font-bold text-white bg-blue-600 rounded-full">
                                {{ $material->order_number }}
                            </span>
                            <span class="text-gray-800">
                                {{ $material->title }}
                            </span>
                        </li>
                    @empty
                        <li class="text-gray-500">
                            Belum ada materi.
                        </li>
                    @endforelse
                </ul>
            </div>

            @php
                $hasPaid = \App\Models\OrderItem::where('course_id', $course->id)
                    ->whereHas('order', function ($q) {
                        $q->where('user_id', auth()->id())
                        ->where('status', 'paid');
                    })->exists();
            @endphp

            @if($hasPaid)
                <div class="px-4 py-2 mt-6 text-green-700 bg-green-100 rounded">
                    Anda sudah membeli kursus ini
                </div>
            @else
                <form method="POST" action="{{ route('orders.store', $course) }}">
                    @csrf
                    <button class="px-6 py-2 mt-6 text-white bg-green-600 rounded">
                        Beli Kursus
                    </button>
                </form>
            @endif
        </div>
    </div>
</x-app-layout>
