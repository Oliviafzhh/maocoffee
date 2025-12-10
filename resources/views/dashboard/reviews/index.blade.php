@extends('layouts.dashboard')

@section('page-title', 'Manajemen Review')

@section('dashboard-content')
<div class="p-6">
    <div class="bg-white rounded-lg shadow-md p-6">
        
        <!-- HEADER -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
            <div>
                <h2 class="text-2xl font-semibold text-gray-800">Manajemen Review</h2>
                <p class="text-gray-600">Pantau dan kelola ulasan masuk dari pelanggan.</p>
            </div>
            
            <!-- Info Total -->
            <div class="bg-blue-50 text-blue-800 px-4 py-2 rounded-lg text-sm font-semibold border border-blue-100">
                <i class="fas fa-database mr-2"></i> Total: {{ $reviews->count() }} Data
            </div>
        </div>

        <!-- Alert Sukses -->
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6 flex items-center gap-2">
                <i class="fas fa-check-circle"></i>
                {{ session('success') }}
            </div>
        @endif

        <!-- Tabel Reviews -->
        <div class="overflow-x-auto">
            <table class="w-full table-auto">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200">
                        <!-- UBAH DI SINI: Foto Profil jadi Foto Menu -->
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Foto Menu</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Nama & Tanggal</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Rating</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Deskripsi</th>
                        <th class="px-4 py-3 text-center text-sm font-semibold text-gray-700">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($reviews as $review)
                    <tr class="hover:bg-gray-50 transition">
                        
                        <!-- Foto Menu (Bentuk Kotak rounded-lg) -->
                        <td class="px-4 py-4 align-top">
                            <a href="{{ route('dashboard.reviews.show', $review->id_review) }}">
                                @if($review->profil_review)
                                    <!-- Ubah roundedg -->
                                    <img src="{{ asset('storage/' . $review->profil_review) }}" 
                                         alt="{{ $review->nama_review }}" 
                                         class="w-16 h-12 object-cover rounded-lg border border-gray-200 shadow-sm hover:scale-110 transition">
                                @else
                                    <!-- Placeholder Kotak -->
                                    <div class="w-16 h-12 bg-gray-100 rounded-lg flex items-center justify-center text-gray-400 text-lg hover:bg-gray-200 transition border border-gray-200">
                                        <i class="fas fa-utensils"></i>
                                    </div>
                                @endif
                            </a>
                        </td>

                        <!-- Nama -->
                        <td class="px-4 py-4 align-top">
                            <p class="font-bold text-gray-800">{{ $review->nama_review }}</p>
                            <p class="text-xs text-gray-500 mt-1">
                                <i class="far fa-clock mr-1"></i> 
                                {{ $review->created_at ? $review->created_at->format('d M Y') : 'Baru saja' }}
                            </p>
                        </td>

                        <!-- Rating -->
                        <td class="px-4 py-4 align-top">
                            <div class="flex items-center bg-yellow-50 px-2 py-1 rounded w-fit border border-yellow-100">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star {{ $i <= $review->bintang ? 'text-yellow-400' : 'text-gray-300' }} text-xs"></i>
                                @endfor
                                <span class="ml-2 text-xs font-bold text-gray-700">{{ $review->bintang }}.0</span>
                            </div>
                        </td>

                        <!-- Deskripsi -->
                        <td class="px-4 py-4 align-top">
                            <div class="text-sm text-gray-600 leading-relaxed max-w-xs truncate">
                                "{{ Str::limit($review->deskripsi_review, 50) }}"
                            </div>
                        </td>

                        <!-- AKSI: LIHAT & HAPUS -->
                        <td class="px-4 py-4 align-top text-center">
                            <div class="flex items-center justify-center gap-2">
                                
                                <!-- 1. Tombol LIHAT (Biru Solid) -->
                                <a href="{{ route('dashboard.reviews.show', $review->id_review) }}" 
                                   class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1.5 rounded-lg transition duration-200 text-sm font-medium flex items-center gap-1 shadow-sm"
                                   title="Lihat Detail">
                                    <i class="fas fa-eye"></i> 
                                    <span>Lihat</span>
                                </a>

                                <!-- 2. Tombol HAPUS (Merah Solid) -->
                                <form action="{{ route('dashboard.reviews.destroy', $review->id_review) }}" method="POST" 
                                      onsubmit="return confirm('Yakin ingin menghapus ulasan dari {{ $review->nama_review }}? Data tidak bisa dikembalikan.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="bg-red-500 hover:bg-red-600 text-white px-3 py-1.5 rounded-lg transition duration-200 text-sm font-medium flex items-center gap-1 shadow-sm"
                                            title="Hapus Ulasan">
                                        <i class="fas fa-trash-alt"></i> 
                                        <span>Hapus</span>
                                    </button>
                                </form>

                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-4 py-12 text-center text-gray-400">
                            <div class="flex flex-col items-center justify-center">
                                <i class="fas fa-inbox text-5xl mb-3 opacity-30"></i>
                                <p class="text-lg font-medium">Belum ada ulasan masuk</p>
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