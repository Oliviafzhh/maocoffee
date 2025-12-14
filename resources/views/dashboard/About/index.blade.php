@extends('layouts.dashboard')

@section('page-title', 'Manajemen About')

@php
function aboutImage($path) {
if (!$path) return asset('image/no-image.png');

// Jika gambar dari storage (upload)
if (file_exists(public_path('storage/' . $path))) {
return asset('storage/' . $path);
}

// Jika gambar dari public (seeder)
if (file_exists(public_path($path))) {
return asset($path);
}

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
                <p class="text-gray-600">Kelola konten About</p>
            </div>

            
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
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Judul</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Dibuat</th>
                        <th class="px-4 py-3 text-center text-sm font-semibold text-gray-700">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200">
                    @forelse($abouts as $item)
                    <tr class="hover:bg-gray-50">

                        <!-- Image -->
                        <td class="px-4 py-3">
                            <img src="{{ aboutImage($item->image) }}"
                                class="w-32 h-20 object-cover rounded-lg">
                        </td>

                        <!-- Title -->
                        <td class="px-4 py-3">
                            <p class="font-semibold text-gray-800">{{ $item->title }}</p>
                            <p class="text-sm text-gray-500">{{ $item->small_title }}</p>
                        </td>

                        <!-- Created -->
                        <td class="px-4 py-3 text-sm text-gray-600">
                            {{ $item->created_at?->format('d M Y') ?? '-' }}
                        </td>

                        <!-- Action -->
                        <td class="px-4 py-4 align-top text-center">
                            <div class="flex items-center justify-center gap-2">

                                <!-- TOMBOL EDIT (BIRU) -->
                                <a href="{{ route('dashboard.about.edit', $item->id) }}"
                                    class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1.5 rounded-lg transition duration-200 text-sm font-medium flex items-center gap-1 shadow-sm"
                                    title="Edit About">
                                    <i class="fas fa-edit"></i>
                                    <span>Edit</span>
                                </a>


                            </div>
                        </td>


                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-4 py-8 text-center text-gray-500">
                            <i class="fas fa-image text-4xl mb-2 block"></i>
                            Tidak ada data About
                        </td>
                    </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

    </div>
</div>
@endsection