<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Edit Kursus') }}
        </h2>
    </x-slot>

    <div class="py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="p-6 bg-white shadow-sm sm:rounded-lg">
            <form action="{{ route('admin.courses.update', $course) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Judul --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Judul Kursus</label>
                    <input type="text" name="title"
                           class="block w-full mt-1 border-gray-300 rounded-md"
                           value="{{ old('title', $course->title) }}" required>
                </div>

                {{-- Kategori --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Kategori</label>
                    <select name="category_id"
                            class="block w-full mt-1 border-gray-300 rounded-md" required>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('category_id', $course->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Deskripsi --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Deskripsi</label>
                    <textarea name="description" rows="3"
                              class="block w-full mt-1 border-gray-300 rounded-md">{{ old('description', $course->description) }}</textarea>
                </div>

                {{-- Harga --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Harga</label>
                    <input type="number" name="price"
                           class="block w-full mt-1 border-gray-300 rounded-md"
                           value="{{ old('price', $course->price) }}" min="0" required>
                </div>

                {{-- Status --}}
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700">Status</label>
                    <select name="status"
                            class="block w-full mt-1 border-gray-300 rounded-md">
                        <option value="inactive" {{ $course->status === 'inactive' ? 'selected' : '' }}>
                            Inactive
                        </option>
                        <option value="active" {{ $course->status === 'active' ? 'selected' : '' }}>
                            Active
                        </option>
                    </select>
                </div>

                <div class="flex justify-end">
                    <a href="{{ route('admin.courses.index') }}"
                       class="px-4 py-2 mr-2 bg-gray-200 rounded-md">Batal</a>
                    <button class="px-4 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-700">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
