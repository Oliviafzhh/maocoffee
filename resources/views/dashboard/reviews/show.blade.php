@extends('layouts.dashboard')

@section('page-title', 'Detail Review')

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

<div class="min-h-screen flex flex-col items-center justify-center px-4">
    <div class="max-w-2xl bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100 mx-auto md:mx-0">
        <div class="grid grid-cols-1 md:grid-cols-12 min-h-[300px]">

            <!-- KOLOM KIRI -->
            <div class="md:col-span-5 bg-[#1A2E25] p-6 text-white flex flex-col items-center text-center relative justify-center">

                <span class="text-[10px] font-bold text-green-200 uppercase tracking-wider mb-3">
                    {{ $review->makanan_img ? 'Foto Makanan' : 'Foto Profil' }}
                </span>

                <!-- FOTO UTAMA -->
                <div class="w-44 h-44 mb-4 relative shadow-2xl transform hover:scale-105 transition duration-500">
                    @if($review->makanan_img)
                    <!-- FOTO MAKANAN -->
                    <img src="{{ reviewImage($review->makanan_img) }}"
                        alt="Foto Makanan"
                        class="w-full h-full object-contain bg-gray-900/20 p-2 rounded-xl border-4 border-white/20">
                    @elseif($review->profil_review)
                    <!-- FOTO PROFIL -->
                    <img src="{{ reviewImage($review->profil_review) }}"
                        alt="{{ $review->nama_review }}"
                        class="w-full h-full object-cover rounded-xl border-4 border-white/20">
                    @else
                    <!-- PLACEHOLDER -->
                    <div class="w-full h-full bg-white/10 rounded-xl flex items-center justify-center text-white/50 text-4xl border-4 border-white/20">
                        <i class="fas fa-user-circle"></i>
                    </div>
                    @endif
                </div>

                <h2 class="text-lg font-bold leading-tight">{{ $review->nama_review }}</h2>
                <p class="text-green-200 text-xs mt-1 mb-4">Pelanggan</p>

                <div class="inline-flex items-center gap-2 bg-white/10 px-3 py-1.5 rounded-full text-[10px] font-medium border border-white/10">
                    <i class="far fa-calendar-alt text-green-300"></i>
                    <span>{{ $review->created_at ? $review->created_at->format('d M Y • H:i') : 'Baru saja' }}</span>
                </div>

                @if($review->profil_review && $review->makanan_img)
                <div class="mt-4 pt-4 border-t border-white/10">
                    <p class="text-xs text-green-200">
                        <i class="fas fa-info-circle mr-1"></i>
                        Juga upload foto profil
                    </p>
                </div>
                @endif
            </div>

            <!-- KOLOM KANAN -->
            <div class="md:col-span-7 p-6 flex flex-col bg-white justify-center">

                <div class="flex items-center justify-between mb-4 border-b border-gray-50 pb-4">
                    <div>
                        <label class="text-[10px] font-bold text-gray-400 uppercase tracking-wide">Rating Pelanggan</label>
                        <div class="flex items-center gap-2 mt-1">
                            <div class="flex text-yellow-400 text-sm">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="{{ $i <= $review->bintang ? 'fas' : 'far' }} fa-star drop-shadow-sm"></i>
                                    @endfor
                            </div>
                            <span class="text-sm font-bold text-yellow-700 bg-yellow-50 px-2 py-0.5 rounded border border-yellow-100">
                                {{ $review->bintang }}.0
                            </span>
                        </div>
                    </div>

                    <form action="{{ route('dashboard.reviews.destroy', $review->id_review) }}" method="POST"
                        onsubmit="return confirm('Hapus review ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="text-red-500 hover:text-red-700 text-xs font-semibold flex items-center gap-1.5 bg-red-50 hover:bg-red-100 px-3 py-1.5 rounded-lg border border-red-100">
                            <i class="fas fa-trash-alt"></i> Hapus
                        </button>
                    </form>
                </div>

                <!-- ULASAN -->
                <div class="flex-1">
                    <label class="text-[10px] font-bold text-gray-400 uppercase tracking-wide mb-2 block">
                        Ulasan Masuk
                    </label>
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

                <!-- FOTO PROFIL BAWAH -->
                @if($review->profil_review && $review->profil_review != $review->makanan_img)
                <div class="mt-6 pt-6 border-t border-gray-100">
                    <label class="text-[10px] font-bold text-gray-400 uppercase tracking-wide mb-2 block">
                        Foto Profil Pelanggan
                    </label>
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-full overflow-hidden border-2 border-gray-200">
                            <img src="{{ reviewImage($review->profil_review) }}"
                                alt="{{ $review->nama_review }}"
                                class="w-full h-full object-cover">
                        </div>
                        <p class="text-xs text-gray-600">
                            Foto profil {{ $review->nama_review }}
                        </p>
                    </div>
                </div>
                @endif

            </div>
        </div>
    </div>

    <!-- KEMBALI -->
    <div class="w-full max-w-2xl flex justify-start mt-6">
        <a href="{{ route('dashboard.reviews.index') }}"
            class="inline-flex items-center gap-2 text-gray-600 hover:text-[#1A2E25] bg-white border border-gray-200 hover:border-[#1A2E25] px-8 py-3 rounded-xl transition text-base font-bold shadow-sm">
            <i class="fas fa-arrow-left text-[#1A2E25]"></i> Kembali ke Daftar
        </a>
    </div>
</div>

@endsection