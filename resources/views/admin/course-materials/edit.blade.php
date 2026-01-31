<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Edit Materi') }}
        </h2>
    </x-slot>

    <div class="py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="p-6 bg-white shadow-sm sm:rounded-lg">
            <form action="{{ route('admin.course-materials.update', $material) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Kursus</label>
                    <select name="course_id" class="block w-full mt-1 border-gray-300 rounded-md">
                        @foreach ($courses as $course)
                            <option value="{{ $course->id }}"
                                {{ $material->course_id === $course->id ? 'selected' : '' }}>
                                {{ $course->title }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Judul Materi</label>
                    <input type="text" name="title"
                           class="block w-full mt-1 border-gray-300 rounded-md"
                           value="{{ old('title', $material->title) }}" required>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">URL Konten</label>
                    <input type="url" name="content_url"
                           class="block w-full mt-1 border-gray-300 rounded-md"
                           value="{{ old('content_url', $material->content_url) }}" required>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700">Urutan</label>
                    <input type="number" name="order_number"
                           class="block w-full mt-1 border-gray-300 rounded-md"
                           value="{{ old('order_number', $material->order_number) }}" min="1" required>
                </div>

                <div class="flex justify-end">
                    <a href="{{ route('admin.course-materials.index') }}"
                       class="px-4 py-2 mr-2 bg-gray-200 rounded-md">Batal</a>
                    <button class="px-4 py-2 text-white bg-blue-600 rounded-md">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
