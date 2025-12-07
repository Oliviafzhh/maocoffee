@extends('layouts.dashboard')

@section('page-title', 'Manajemen Paket')

@php
use Illuminate\Support\Str;

function menuImage($path) {
    if (!$path) {
        return asset('image/no-image.png');
    }

    // Jika sudah hasil upload (storage)
    if (Str::startsWith($path, 'storage/')) {
        return asset($path);
    }

    // ambil dari public/image/menu (seeder)
    return asset('image/menu/' . $path);
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
                    <tr class="bg-gray-50">
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Gambar</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">ID</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Nama Paket</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Deskripsi Menu</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Harga</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($pakets as $paket)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3">
                            <img
                                src="{{ menuImage($paket->img_paket) }}"
                                class="w-16 h-16 object-cover rounded-lg">

                        </td>
                        <td class="px-4 py-3">
                            <span class="text-sm text-gray-600">#{{ $paket->id_paket }}</span>
                        </td>
                        <td class="px-4 py-3">
                            <p class="font-medium text-gray-800">{{ $paket->nama_paket }}</p>
                        </td>
                        <td class="px-4 py-3">
                            <p class="text-sm text-gray-600">{{ Str::limit($paket->deeskripsi_menu, 100) }}</p>
                        </td>
                        <td class="px-4 py-3">
                            <p class="text-gray-800 font-medium">Rp {{ number_format($paket->harga_paket, 0, ',', '.') }}</p>
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex gap-2">
                                <a href="{{ route('dashboard.paket.edit', $paket->id_paket) }}"
                                    class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm transition duration-200">
                                    <i class="fas fa-edit mr-1"></i> Edit
                                </a>
                                <form action="{{ route('dashboard.paket.destroy', $paket->id_paket) }}" method="POST"
                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus paket ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm transition duration-200">
                                        <i class="fas fa-trash mr-1"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-4 py-8 text-center text-gray-500">
                            <i class="fas fa-box-open text-4xl mb-2 block"></i>
                            Tidak ada paket yang ditemukan
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection