@extends('layouts.dashboard')

@section('page-title', 'Manajemen Paket')

@php
use Illuminate\Support\Str;

// Helper sederhana untuk gambar
function menuImage($path) {
if (!$path) {
return asset('image/no-image.png');
}

if (Str::startsWith($path, 'paket/') || Str::startsWith($path, 'menu/')) {
return asset('storage/' . $path);
}

return asset('storage/' . $path);
}
@endphp

@section('dashboard-content')
<div class="p-6">
    <div class="bg-white rounded-lg shadow-md p-6">
        <!-- Header dengan Tombol Tambah -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
            <div>
                <h2 class="text-2xl font-semibold text-gray-800">Manajemen Paket</h2>
                <p class="text-gray-600">Kelola paket makanan dan minuman</p>
            </div>

            <!-- Tombol Tambah Paket -->
            <a href="{{ route('dashboard.paket.create') }}"
                class="bg-[#2E4239] hover:bg-[#1a2a22] text-white px-4 py-2 rounded-lg transition duration-200 flex items-center gap-2 whitespace-nowrap">
                <i class="fas fa-plus"></i>
                Tambah Paket
            </a>
        </div>

        @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
        @endif

        <!-- Tabel Paket -->
        <div class="overflow-x-auto">
            <table class="w-full table-auto">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-100">
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700 w-24">Gambar</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700 w-16">ID</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700 whitespace-nowrap">Nama Paket</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Deskripsi Menu</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700 whitespace-nowrap">Harga</th>
                        <th class="px-4 py-3 text-center text-sm font-semibold text-gray-700">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($pakets as $paket)
                    <tr class="hover:bg-gray-50">
                        <!-- Kolom Gambar -->
                        <td class="px-4 py-3 align-top">
                            @if($paket->image_paket)
                            <img src="{{ asset('storage/' . $paket->image_paket) }}"
                                alt="{{ $paket->nama_paket }}"
                                class="w-16 h-16 object-cover rounded-lg shadow-sm border border-gray-200">
                            @else
                            <div class="w-16 h-16 bg-gray-100 rounded-lg flex items-center justify-center text-gray-400">
                                <i class="fas fa-box text-xl"></i>
                            </div>
                            @endif
                        </td>

                        <td class="px-4 py-3 align-top">
                            <span class="text-sm text-gray-600 font-mono">#{{ $paket->id_paket }}</span>
                        </td>

                        <td class="px-4 py-3 align-top">
                            <p class="font-bold text-gray-800 text-sm">{{ $paket->nama_paket }}</p>
                        </td>

                        <td class="px-4 py-3 align-top">
                            <p class="text-xs text-gray-500 line-clamp-2 max-w-sm leading-relaxed">{{ $paket->deeskripsi_menu }}</p>
                        </td>

                        <!-- Kolom Harga (Warna Hijau) -->
                        <td class="px-4 py-3 align-top whitespace-nowrap">
                            <span class="bg-green-100 text-green-800 px-2.5 py-1 rounded-md text-xs font-bold border border-green-200">
                                Rp {{ number_format($paket->harga_paket, 0, ',', '.') }}
                            </span>
                        </td>

                        <td class="px-4 py-4 align-top text-center">
                            <div class="flex items-center justify-center gap-2">

                                <!-- TOMBOL EDIT (BIRU SOLID) -->
                                <a href="{{ route('dashboard.paket.edit', $paket->id_paket) }}"
                                    class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1.5 rounded-lg transition duration-200 text-sm font-medium flex items-center gap-1 shadow-sm"
                                    title="Edit Paket">
                                    <i class="fas fa-edit"></i>
                                    <span>Edit</span>
                                </a>

                                <!-- TOMBOL HAPUS (MERAH SOLID) -->
                                <form action="{{ route('dashboard.paket.destroy', $paket->id_paket) }}" method="POST"
                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus paket ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-500 hover:bg-red-600 text-white px-3 py-1.5 rounded-lg transition duration-200 text-sm font-medium flex items-center gap-1 shadow-sm"
                                        title="Hapus Paket">
                                        <i class="fas fa-trash-alt"></i>
                                        <span>Hapus</span>
                                    </button>
                                </form>

                            </div>
                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-4 py-12 text-center text-gray-500">
                            <div class="flex flex-col items-center justify-center">
                                <i class="fas fa-box-open text-4xl mb-3 opacity-30"></i>
                                <p class="font-medium">Tidak ada paket menu</p>
                                <p class="text-xs text-gray-400 mt-1">Silakan tambahkan paket baru.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection