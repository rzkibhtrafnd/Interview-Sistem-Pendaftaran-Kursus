<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Kursus') }}
        </h2>
    </x-slot>

    <div class="flex flex-col-reverse gap-6 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8 lg:flex-row-reverse">

        {{-- Sidebar kategori (desktop) --}}
        <div class="hidden w-full lg:block lg:w-1/4">
            <div class="grid grid-cols-1 gap-2 p-4 bg-white rounded shadow">
                <a href="{{ route('courses.index') }}"
                   class="px-2 py-1 text-sm rounded
                   {{ request('category_id') ? '' : 'font-bold text-blue-600 bg-blue-50' }}">
                    Semua
                </a>
                @foreach($categories as $category)
                    <a href="{{ route('courses.index', ['category_id' => $category->id]) }}"
                       class="px-2 py-1 text-sm rounded
                       {{ request('category_id') == $category->id ? 'font-bold text-blue-600 bg-blue-50' : '' }}">
                        {{ $category->name }}
                    </a>
                @endforeach
            </div>
        </div>

        <div class="flex-1">

            {{-- Filter mobile --}}
            <div class="p-4 mb-6 bg-white rounded-lg shadow-md lg:hidden">
                <form method="GET" action="{{ route('courses.index') }}">
                    <select name="category_id"
                            onchange="this.form.submit()"
                            class="w-full px-3 py-2 text-sm border rounded-lg">
                        <option value="">Semua Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </form>
            </div>

            {{-- Search --}}
            <div class="hidden p-4 mb-6 bg-white rounded-lg shadow-md lg:block">
                <form method="GET" action="{{ route('courses.index') }}" class="flex gap-2">
                    @if(request('category_id'))
                        <input type="hidden" name="category_id" value="{{ request('category_id') }}">
                    @endif
                    <input type="text" name="search" value="{{ request('search') }}"
                           placeholder="Cari kursus"
                           class="flex-1 px-4 py-2 text-sm border rounded-lg">
                    <button class="px-4 py-2 text-sm text-white bg-blue-600 rounded-lg">
                        Cari
                    </button>
                </form>
            </div>

            {{-- Grid kursus --}}
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @forelse($courses as $course)
                    <div class="flex flex-col p-4 bg-white rounded-lg shadow hover:shadow-lg">
                        <h3 class="text-lg font-semibold text-gray-800">
                            {{ $course->title }}
                        </h3>

                        <p class="text-sm text-gray-600">
                            {{ $course->category->name }}
                        </p>

                        <p class="mt-2 text-sm text-gray-700 line-clamp-3">
                            {{ $course->description }}
                        </p>

                        <div class="mt-3 text-sm text-gray-600">
                            📘 {{ $course->materials_count }} Materi
                        </div>

                        <div class="mt-2 font-semibold text-blue-600">
                            Rp {{ number_format($course->price, 0, ',', '.') }}
                        </div>

                        <a href="{{ route('courses.show', $course) }}"
                           class="flex items-center justify-center px-3 py-2 mt-4 text-sm text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                            Lihat Detail
                        </a>
                    </div>
                @empty
                    <p class="col-span-3 text-center text-gray-500">
                        Kursus tidak ditemukan.
                    </p>
                @endforelse
            </div>

            <div class="mt-6">
                {{ $courses->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
