@extends('layouts.dashboard')

@section('page-title', 'Manajemen About')

@php
function aboutImage($path) {
if (!$path) {
return asset('image/no-image.png');
}

// Jika gambar dari storage (upload user)
if (file_exists(public_path('storage/' . $path))) {
return asset('storage/' . $path);
}

// Jika gambar dari public (seeder)
if (file_exists(public_path($path))) {
return asset($path);
}

// Fallback default
return asset('image/no-image.png');
}
@endphp

@section('dashboard-content')
<div class="p-6">
    <div class="bg-white rounded-lg shadow-md p-6">

        <!-- Header -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
            <div>
                <h2 class="text-2xl font-semibold text-gray-800">Manajemen About</h2>
                <p class="text-gray-600">Kelola gambar dan konten pada bagian About</p>
            </div>

            <a href="{{ route('dashboard.about.create') }}"
                class="bg-[#2E4239] hover:bg-[#1a2a22] text-white px-4 py-2 rounded-lg transition duration-200 flex items-center gap-2 whitespace-nowrap">
                <i class="fas fa-plus"></i>
                Tambah Gambar
            </a>
        </div>

        <!-- Alert -->
        @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
        @endif

        <!-- Tabel -->
        <div class="overflow-x-auto">
            <table class="w-full table-auto">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Gambar</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Dibuat</th>
                        <th class="px-4 py-3 text-center text-sm font-semibold text-gray-700">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200">
                    @forelse($about as $item)
                    <tr class="hover:bg-gray-50">

                        <td class="px-4 py-3">
                            <img src="{{ aboutImage($item->img_about) }}"
                                class="w-32 h-20 object-cover rounded-lg">
                        </td>

                        <td class="px-4 py-3">
                            <p class="text-gray-700 text-sm">
                                {{ $item->created_at ? $item->created_at->format('d M Y') : '-' }}
                            </p>
                        </td>

                        <td class="px-4 py-3 text-center">
                            <div class="flex justify-center gap-2">

                                <a href="{{ route('dashboard.about.edit', $item->id) }}"
                                    class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm">
                                    <i class="fas fa-edit mr-1"></i> Edit
                                </a>

                                <form action="{{ route('dashboard.about.destroy', $item->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus gambar ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">
                                        <i class="fas fa-trash mr-1"></i> Hapus
                                    </button>
                                </form>

                            </div>
                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="px-4 py-8 text-center text-gray-500">
                            <i class="fas fa-image text-4xl mb-2 block"></i>
                            Tidak ada gambar About
                        </td>
                    </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

    </div>
</div>
@endsection