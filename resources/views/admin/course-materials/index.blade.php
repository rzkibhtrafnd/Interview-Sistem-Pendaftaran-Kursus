<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Manajemen Materi Kursus') }}
        </h2>
    </x-slot>

    <div class="py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="p-6 bg-white shadow-md sm:rounded-lg">

            <div class="flex justify-between mb-6">
                <h3 class="text-lg font-semibold">Daftar Materi</h3>
                <a href="{{ route('admin.course-materials.create') }}"
                   class="px-4 py-2 text-sm text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                    Tambah Materi
                </a>
            </div>

            @if(session('success'))
                <div class="p-3 mb-4 text-green-700 bg-green-100 border rounded">
                    {{ session('success') }}
                </div>
            @endif

            <table class="min-w-full text-sm divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left">No</th>
                        <th class="px-4 py-2 text-left">Kursus</th>
                        <th class="px-4 py-2 text-left">Judul Materi</th>
                        <th class="px-4 py-2 text-center">Urutan</th>
                        <th class="px-4 py-2 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($materials as $material)
                        <tr class="border-t hover:bg-gray-50">
                            <td class="px-4 py-2">{{ $loop->iteration }}</td>
                            <td class="px-4 py-2">{{ $material->course->title }}</td>
                            <td class="px-4 py-2">{{ $material->title }}</td>
                            <td class="px-4 py-2 text-center">{{ $material->order_number }}</td>
                            <td class="px-4 py-2 space-x-2 text-right">
                                <a href="{{ route('admin.course-materials.edit', $material) }}"
                                   class="px-3 py-1 text-white bg-yellow-500 rounded">Edit</a>
                                <form action="{{ route('admin.course-materials.destroy', $material) }}"
                                      method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Hapus materi ini?')"
                                            class="px-3 py-1 text-white bg-red-600 rounded">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-3 text-center text-gray-500">
                                Belum ada materi.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-6">
                {{ $materials->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
