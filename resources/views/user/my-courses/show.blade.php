<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            {{ $course->title }}
        </h2>
    </x-slot>

    <div class="max-w-5xl py-6 mx-auto space-y-6">

        {{-- DESKRIPSI KURSUS --}}
        <div class="p-6 bg-white rounded-lg shadow">
            <p class="text-gray-700">
                {{ $course->description }}
            </p>
        </div>

        {{-- DAFTAR MATERI --}}
        <div class="p-6 bg-white rounded-lg shadow">
            <h3 class="mb-4 text-lg font-semibold">
                Daftar Materi
            </h3>

            <ul class="space-y-3">
                @foreach($course->materials as $material)

                    @php
                        $completed = in_array($material->id, $completedMaterialIds);
                    @endphp

                    <li class="flex items-center justify-between p-3 border rounded
                        {{ $completed ? 'bg-green-50 border-green-300' : '' }}">

                        <div>
                            <span class="font-medium">
                                {{ $material->order_number }}. {{ $material->title }}
                            </span>

                            @if($completed)
                                <span class="ml-2 text-xs font-semibold text-green-700">
                                    ✔ Selesai
                                </span>
                            @endif
                        </div>

                        <div class="flex gap-2">
                            <a href="{{ $material->content_url }}"
                               target="_blank"
                               class="px-3 py-1 text-white bg-green-600 rounded hover:bg-green-700">
                                Tonton
                            </a>

                            @unless($completed)
                                <form method="POST"
                                      action="{{ route('materials.complete', $material) }}">
                                    @csrf
                                    <button type="submit"
                                            class="px-3 py-1 text-white bg-blue-600 rounded hover:bg-blue-700">
                                        Tandai Selesai
                                    </button>
                                </form>
                            @endunless
                        </div>

                    </li>
                @endforeach
            </ul>
        </div>

        {{-- SERTIFIKAT --}}
        @if($certificate)
            <div class="p-6 border border-purple-300 rounded-lg bg-purple-50">
                <h3 class="mb-2 text-lg font-semibold text-purple-800">
                    🎉 Selamat!
                </h3>

                <p class="mb-4 text-purple-700">
                    Anda telah menyelesaikan seluruh materi kursus ini.
                </p>

                <a href="{{ route('certificates.download', $course->id) }}"
                   class="inline-block px-4 py-2 text-white bg-purple-600 rounded hover:bg-purple-700">
                    Cetak Sertifikat
                </a>
            </div>
        @endif

    </div>
</x-app-layout>
