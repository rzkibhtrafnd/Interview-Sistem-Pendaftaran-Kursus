<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Kursus Saya
        </h2>
    </x-slot>

    <div class="py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">

            @forelse($courses as $course)
                <div class="p-5 bg-white rounded-lg shadow">
                    <h3 class="mb-2 text-lg font-semibold">
                        {{ $course->title }}
                    </h3>

                    <p class="mb-4 text-sm text-gray-600">
                        {{ Str::limit($course->description, 100) }}
                    </p>

                    <a href="{{ route('my-courses.show', $course) }}"
                       class="inline-block px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">
                        Lihat Materi
                    </a>
                </div>
            @empty
                <p class="col-span-3 text-center text-gray-500">
                    Anda belum membeli kursus apa pun.
                </p>
            @endforelse

        </div>
    </div>
</x-app-layout>
