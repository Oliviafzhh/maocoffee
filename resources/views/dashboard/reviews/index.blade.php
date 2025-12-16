@extends('layouts.dashboard')

@section('page-title', 'Manajemen Review')

@php
function reviewImage($path) {
if (!$path) {
return asset('image/no-image.png');
}

if (file_exists(public_path('storage/' . $path))) {
return asset('storage/' . $path);
}

return asset($path);
}
@endphp

@section('dashboard-content')
<div class="p-6">
    <div class="bg-white rounded-lg shadow-md p-6">

        <!-- HEADER -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
            <div>
                <h2 class="text-2xl font-semibold text-gray-800">Manajemen Review</h2>
                <p class="text-gray-600">Pantau dan kelola ulasan masuk dari pelanggan.</p>
            </div>

            <div class="bg-blue-50 text-blue-800 px-4 py-2 rounded-lg text-sm font-semibold border border-blue-100">
                <i class="fas fa-database mr-2"></i> Total: {{ $reviews->count() }} Data
            </div>
        </div>

        @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6 flex items-center gap-2">
            <i class="fas fa-check-circle"></i>
            {{ session('success') }}
        </div>
        @endif

        <!-- TABEL REVIEW -->
        <div class="overflow-x-auto">
            <table class="w-full table-auto">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200">
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Foto Makanan</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Foto Profil</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Nama & Tanggal</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Rating</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Deskripsi</th>
                        <th class="px-4 py-3 text-center text-sm font-semibold text-gray-700">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200">
                    @forelse($reviews as $review)
                    <tr class="hover:bg-gray-50 transition">

                        <!-- FOTO MAKANAN -->
                        <td class="px-4 py-4 align-top">
                            <a href="{{ route('dashboard.reviews.show', $review->id_review) }}">
                                @if($review->makanan_img)
                                <img src="{{ reviewImage($review->makanan_img) }}"
                                    class="w-16 h-12 object-cover rounded-lg border border-gray-200 shadow-sm hover:scale-110 transition">
                                @else
                                <div class="w-16 h-12 bg-gray-100 rounded-lg flex items-center justify-center text-gray-400 border">
                                    <i class="fas fa-hamburger"></i>
                                </div>
                                @endif
                            </a>
                        </td>

                        <!-- FOTO PROFIL -->
                        <td class="px-4 py-4 align-top">
                            <a href="{{ route('dashboard.reviews.show', $review->id_review) }}">
                                @if($review->profil_review)
                                <img src="{{ reviewImage($review->profil_review) }}"
                                    class="w-16 h-12 object-cover rounded-lg border border-gray-200 shadow-sm hover:scale-110 transition">
                                @else
                                <div class="w-16 h-12 bg-gray-100 rounded-lg flex items-center justify-center text-gray-400 border">
                                    <i class="fas fa-user"></i>
                                </div>
                                @endif
                            </a>
                        </td>

                        <!-- NAMA -->
                        <td class="px-4 py-4 align-top">
                            <p class="font-bold text-gray-800">{{ $review->nama_review }}</p>
                            <p class="text-xs text-gray-500 mt-1">
                                <i class="far fa-clock mr-1"></i>
                                {{ $review->created_at ? $review->created_at->format('d M Y') : 'Baru saja' }}
                            </p>
                        </td>

                        <!-- RATING -->
                        <td class="px-4 py-4 align-top">
                            <div class="flex items-center bg-yellow-50 px-2 py-1 rounded border border-yellow-100 w-fit">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star {{ $i <= $review->bintang ? 'text-yellow-400' : 'text-gray-300' }} text-xs"></i>
                                    @endfor
                                    <span class="ml-2 text-xs font-bold text-gray-700">{{ $review->bintang }}.0</span>
                            </div>
                        </td>

                        <!-- DESKRIPSI -->
                        <td class="px-4 py-4 align-top">
                            <div class="text-sm text-gray-600 leading-relaxed max-w-xs truncate">
                                "{{ Str::limit($review->deskripsi_review, 50) }}"
                            </div>
                        </td>

                        <!-- AKSI -->
                        <td class="px-4 py-4 align-top text-center">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('dashboard.reviews.show', $review->id_review) }}"
                                    class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1.5 rounded-lg text-sm flex items-center gap-1">
                                    <i class="fas fa-eye"></i> Lihat
                                </a>

                                <form action="{{ route('dashboard.reviews.destroy', $review->id_review) }}"
                                    method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus ulasan dari {{ $review->nama_review }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-500 hover:bg-red-600 text-white px-3 py-1.5 rounded-lg text-sm flex items-center gap-1">
                                        <i class="fas fa-trash-alt"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-4 py-12 text-center text-gray-400">
                            Belum ada ulasan masuk
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection