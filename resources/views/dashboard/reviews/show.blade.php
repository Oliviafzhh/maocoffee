@extends('layouts.dashboard')

@section('page-title', 'Detail Review')

@section('dashboard-content')

<div class="min-h-screen flex flex-col items-center justify-center px-4">


    <!-- Container Utama -->
    <div class="max-w-2xl bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100 mx-auto md:mx-0">
        <div class="grid grid-cols-1 md:grid-cols-12 min-h-[300px]">

            <!-- KOLOM KIRI: Foto Menu & Info Pelanggan -->
            <div class="md:col-span-5 bg-[#1A2E25] p-6 text-white flex flex-col items-center text-center relative justify-center">

                <!-- Label -->
                <span class="text-[10px] font-bold text-green-200 uppercase tracking-wider mb-3">Foto Menu</span>

                <!-- FOTO MENU (Kotak) -->
                <div class="w-44 h-44 mb-4 relative shadow-2xl transform hover:scale-105 transition duration-500">
                    @if($review->profil_review)
                    <!-- Tampilkan Foto Menu -->
                    <img src="{{ asset('storage/' . $review->profil_review) }}"
                        alt="{{ $review->nama_review }}"
                        class="w-full h-full object-cover rounded-xl border-4 border-white/20">
                    @else
                    <!-- Placeholder Utensils jika tidak ada foto -->
                    <div class="w-full h-full bg-white/10 rounded-xl flex items-center justify-center text-white/50 text-4xl border-4 border-white/20">
                        <i class="fas fa-utensils"></i>
                    </div>
                    @endif
                </div>

                <h2 class="text-lg font-bold leading-tight">{{ $review->nama_review }}</h2>
                <p class="text-green-200 text-xs mt-1 mb-4">Pelanggan</p>

                <div class="inline-flex items-center gap-2 bg-white/10 px-3 py-1.5 rounded-full text-[10px] font-medium border border-white/10">
                    <i class="far fa-calendar-alt text-green-300"></i>
                    <span>{{ $review->created_at ? $review->created_at->format('d M Y • H:i') : 'Baru saja' }}</span>
                </div>
            </div>

            <!-- KOLOM KANAN: Isi Review -->
            <div class="md:col-span-7 p-6 flex flex-col bg-white justify-center">

                <!-- Header Kanan: Rating & Hapus -->
                <div class="flex items-center justify-between mb-4 border-b border-gray-50 pb-4">
                    <div>
                        <label class="text-[10px] font-bold text-gray-400 uppercase tracking-wide">Rating Pelanggan</label>
                        <div class="flex items-center gap-2 mt-1">
                            <div class="flex text-yellow-400 text-sm">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="{{ $i <= $review->bintang ? 'fas' : 'far' }} fa-star drop-shadow-sm"></i>
                                    @endfor
                            </div>
                            <span class="text-sm font-bold text-gray-800 bg-yellow-50 px-2 py-0.5 rounded text-yellow-700 border border-yellow-100">{{ $review->bintang }}.0</span>
                        </div>
                    </div>

                    <!-- Tombol Hapus -->
                    <form action="{{ route('dashboard.reviews.destroy', $review->id_review) }}" method="POST"
                        onsubmit="return confirm('Hapus review ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:text-red-700 text-xs font-semibold flex items-center gap-1.5 transition bg-red-50 hover:bg-red-100 px-3 py-1.5 rounded-lg border border-red-100 hover:border-red-200">
                            <i class="fas fa-trash-alt"></i> Hapus
                        </button>
                    </form>
                </div>

                <!-- Review Text -->
                <div class="flex-1">
                    <label class="text-[10px] font-bold text-gray-400 uppercase tracking-wide mb-2 block">Ulasan Masuk</label>
                    <div class="bg-gray-50 p-4 rounded-xl border border-gray-100 min-h-[120px] flex items-center shadow-inner">
                        <div class="w-full">
                            <i class="fas fa-quote-left text-gray-300 text-xs mb-1"></i>
                            <p class="text-gray-700 text-sm leading-relaxed italic px-2">
                                "{{ $review->deskripsi_review }}"
                            </p>
                            <div class="text-right">
                                <i class="fas fa-quote-right text-gray-300 text-xs mt-1"></i>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
    <div class="w-full max-w-2xl flex justify-start">
        <a href="{{ route('dashboard.reviews.index') }}"
            class="inline-flex items-center gap-2 text-gray-600 hover:text-[#1A2E25] bg-white border border-gray-200 hover:border-[#1A2E25] px-8 py-3 rounded-xl transition-all duration-200 text-base font-bold shadow-sm hover:shadow-md">
            <i class="fas fa-arrow-left text-[#1A2E25]"></i> Kembali
        </a>
    </div>
</div>

</div>
@endsection