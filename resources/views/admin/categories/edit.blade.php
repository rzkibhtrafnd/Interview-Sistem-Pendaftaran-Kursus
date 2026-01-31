<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Edit Kategori') }}
        </h2>
    </x-slot>

    <div class="py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="p-6 bg-white shadow-sm sm:rounded-lg">
            <form action="{{ route('admin.categories.update', $category) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Nama --}}
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">
                        Nama Kategori
                    </label>
                    <input
                        type="text"
                        name="name"
                        id="name"
                        class="block w-full mt-1 border-gray-300 rounded-md shadow-sm"
                        value="{{ old('name', $category->name) }}"
                        required
                    >
                    @error('name')
                        <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Deskripsi --}}
                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700">
                        Deskripsi
                    </label>
                    <textarea
                        name="description"
                        id="description"
                        rows="3"
                        class="block w-full mt-1 border-gray-300 rounded-md shadow-sm"
                    >{{ old('description', $category->description) }}</textarea>
                    @error('description')
                        <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                    @enderror
                </div>

                <div class="flex justify-end">
                    <a href="{{ route('admin.categories.index') }}"
                       class="px-4 py-2 mr-2 bg-gray-200 rounded-md">
                        Batal
                    </a>
                    <button
                        type="submit"
                        class="px-4 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-700">
                        Edit
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
