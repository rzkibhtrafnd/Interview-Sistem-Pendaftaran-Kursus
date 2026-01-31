<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Manajemen Kursus') }}
        </h2>
    </x-slot>

    <div class="py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="p-6 overflow-hidden bg-white shadow-md sm:rounded-lg">

            {{-- Header --}}
            <div class="flex justify-between mb-6">
                <h3 class="text-lg font-semibold text-gray-800">
                    Daftar Kursus
                </h3>
                <a href="{{ route('admin.courses.create') }}"
                   class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                    + Tambah Kursus
                </a>
            </div>

            {{-- Notifikasi --}}
            @if(session('success'))
                <div class="p-3 mb-4 text-green-700 bg-green-100 border border-green-300 rounded-md">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Tabel --}}
            <table class="min-w-full text-sm border divide-y divide-gray-200 rounded-lg">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left">No</th>
                        <th class="px-4 py-2 text-left">Judul</th>
                        <th class="px-4 py-2 text-left">Kategori</th>
                        <th class="px-4 py-2 text-right">Harga</th>
                        <th class="px-4 py-2 text-center">Status</th>
                        <th class="px-4 py-2 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($courses as $course)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2">{{ $loop->iteration }}</td>
                            <td class="px-4 py-2">{{ $course->title }}</td>
                            <td class="px-4 py-2">{{ $course->category->name }}</td>
                            <td class="px-4 py-2 text-right">
                                Rp {{ number_format($course->price, 0, ',', '.') }}
                            </td>
                            <td class="px-4 py-2 text-center">
                                <span class="px-2 py-1 text-xs rounded
                                    {{ $course->status === 'active'
                                        ? 'bg-green-100 text-green-700'
                                        : 'bg-gray-200 text-gray-600' }}">
                                    {{ ucfirst($course->status) }}
                                </span>
                            </td>
                            <td class="px-4 py-2 space-x-2 text-right">
                                <a href="{{ route('admin.courses.edit', $course) }}"
                                   class="px-3 py-1 text-sm text-white bg-yellow-500 rounded hover:bg-yellow-600">
                                    Edit
                                </a>
                                <form action="{{ route('admin.courses.destroy', $course) }}"
                                      method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Yakin hapus kursus ini?')"
                                            class="px-3 py-1 text-sm text-white bg-red-600 rounded hover:bg-red-700">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-3 text-center text-gray-500">
                                Belum ada kursus.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>

        <div class="mt-6">
            {{ $courses->links() }}
        </div>
    </div>
</x-app-layout>
