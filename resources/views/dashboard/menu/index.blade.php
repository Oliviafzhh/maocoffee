@extends('layouts.dashboard')

@section('page-title', 'Manajemen Menu')


@php
function menuImage($path) {
if (!$path) return asset('image/no-image.png');

if (file_exists(public_path('storage/' . $path))) {
return asset('storage/' . $path);
}

return asset($path);
}
@endphp

@section('dashboard-content')
<div class="p-6">
    <div class="bg-white rounded-lg shadow-md p-6">
        <!-- Header dengan Filter dan Tombol Tambah -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
            <div>
                <h2 class="text-2xl font-semibold text-gray-800">Manajemen Menu</h2>
                <p class="text-gray-600">Kelola menu makanan, minuman, dan snack</p>
            </div>

            <div class="flex flex-col sm:flex-row gap-3 w-full md:w-auto">
                <!-- Filter Kategori -->
                <select id="filterKategori" class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2E4239]">
                    <option value="all" {{ $kategori == 'all' ? 'selected' : '' }}>Semua Kategori</option>
                    <option value="Food" {{ $kategori == 'Food' ? 'selected' : '' }}>Makanan</option>
                    <option value="Drink" {{ $kategori == 'Drink' ? 'selected' : '' }}>Minuman</option>
                    <option value="Snack" {{ $kategori == 'Snack' ? 'selected' : '' }}>Snack</option>
                </select>

                <!-- Tombol Tambah Menu -->
                <a href="{{ route('dashboard.menu.create') }}"
                    class="bg-[#2E4239] hover:bg-[#1a2a22] text-white px-4 py-2 rounded-lg transition duration-200 flex items-center gap-2 whitespace-nowrap">
                    <i class="fas fa-plus"></i>
                    Tambah Menu
                </a>
            </div>
        </div>

        @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
        @endif

        <!-- Tabel Menu -->
        <div class="overflow-x-auto">
            <table class="w-full table-auto">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Gambar</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Nama Menu</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Kategori</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Harga</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Stok</th>
                        <th class="px-4 py-3 text-center text-sm font-semibold text-gray-700">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($menus as $menu)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3">
                            <img
                                src="{{ menuImage($menu->img_menu) }}"
                                class="w-16 h-16 object-cover rounded-lg">
                        </td>
                        <td class="px-4 py-3">
                            <div>
                                <p class="font-medium text-gray-800">{{ $menu->nama_menu }}</p>
                                <p class="text-sm text-gray-600">{{ Str::limit($menu->deskripsi_menu, 50) }}</p>
                            </div>
                        </td>
                        <td class="px-4 py-3">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                {{ $menu->kategori == 'Food' ? 'bg-green-100 text-green-800' : '' }}
                                {{ $menu->kategori == 'Drink' ? 'bg-blue-100 text-blue-800' : '' }}
                                {{ $menu->kategori == 'Snack' ? 'bg-yellow-100 text-yellow-800' : '' }}">
                                {{ $menu->kategori }}
                            </span>
                        </td>
                        <td class="px-4 py-3">
                            <p class="text-gray-800 font-medium">Rp {{ number_format($menu->harga, 0, ',', '.') }}</p>
                        </td>
                        <td class="px-4 py-3">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                {{ $menu->stok > 10 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $menu->stok }} pcs
                            </span>
                        </td>
                        <td class="px-4 py-4 align-top text-center">
                            <div class="flex items-center justify-center gap-2">

                                <!-- TOMBOL EDIT (BIRU SOLID) -->
                                <a href="{{ route('dashboard.menu.edit', $menu->id_menu) }}"
                                    class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1.5 rounded-lg transition duration-200 text-sm font-medium flex items-center gap-1 shadow-sm"
                                    title="Edit Menu">
                                    <i class="fas fa-edit"></i>
                                    <span>Edit</span>
                                </a>

                                <!-- TOMBOL HAPUS (MERAH SOLID) -->
                                <form action="{{ route('dashboard.menu.destroy', $menu->id_menu) }}" method="POST"
                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus menu ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-500 hover:bg-red-600 text-white px-3 py-1.5 rounded-lg transition duration-200 text-sm font-medium flex items-center gap-1 shadow-sm"
                                        title="Hapus Menu">
                                        <i class="fas fa-trash-alt"></i>
                                        <span>Hapus</span>
                                    </button>
                                </form>

                            </div>
                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-4 py-8 text-center text-gray-500">
                            <i class="fas fa-utensils text-4xl mb-2 block"></i>
                            Tidak ada menu yang ditemukan
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    // Filter kategori
    document.getElementById('filterKategori').addEventListener('change', function() {
        const kategori = this.value;
        window.location.href = `{{ route('dashboard.menu.index') }}?kategori=${kategori}`;
    });
</script>
@endsection