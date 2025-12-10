@extends('layouts.dashboard')

@section('page-title', 'Edit Paket Menu')

@php
        function paketImage($path) {
        if (!$path) return asset('image/no-image.png'); 
        
        if (file_exists(public_path('storage/' . $path))) {
            return asset('storage/' . $path);
        }
        
        return asset($path);
    }
@endphp

@section('dashboard-content')
<div class="p-8 bg-gray-50 min-h-screen">
    <div class="max-w-5xl mx-auto">

        <!-- Header Page -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8 border-b border-gray-200 pb-6">
            <div>
                <h2 class="text-3xl font-bold text-gray-800 tracking-tight">Edit Paket</h2>
                <p class="text-gray-500 mt-2 text-sm">Perbarui informasi paket menu promo Anda.</p>
            </div>
        </div>

        <!-- Error Messages -->
        @if($errors->any())
        <div class="bg-red-50 border border-red-200 rounded-xl p-4 mb-8 flex items-start gap-3 shadow-sm animate-fade-in">
            <div class="bg-red-100 p-2 rounded-full text-red-600 shrink-0">
                <i class="fas fa-exclamation-triangle text-sm"></i>
            </div>
            <div>
                <h3 class="text-red-800 font-semibold text-sm">Terdapat kesalahan input</h3>
                <ul class="list-disc list-inside text-red-600 text-xs mt-1 space-y-1">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif

        <form id="paketForm" action="{{ route('dashboard.paket.update', $paket->id_paket) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf
            @method('PUT')

            <!-- Card Utama -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="p-6 md:p-8 border-b border-gray-50 bg-gray-50/30 flex items-center justify-between">
                    <h3 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                        <i class="fas fa-box-open text-[#2E4239]"></i> Informasi Paket
                    </h3>
                    <span class="text-xs text-gray-400 font-medium">* Wajib diisi</span>
                </div>

                <div class="p-6 md:p-8 space-y-8">

                    <!-- Row 1: Nama & Harga -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Nama Paket -->
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-gray-700">Nama Paket <span class="text-red-500">*</span></label>
                            <input type="text" name="nama_paket" value="{{ old('nama_paket', $paket->nama_paket) }}"
                                class="w-full px-4 py-3.5 bg-gray-50/50 border border-gray-200 rounded-xl text-gray-800 shadow-sm focus:shadow-md focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#2E4239]/20 focus:border-[#2E4239] transition-all placeholder-gray-400"
                                placeholder="Contoh: Paket Hemat Berdua" required>
                        </div>

                        <!-- Harga Paket -->
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-gray-700">Harga Paket <span class="text-red-500">*</span></label>
                            <div class="flex items-center bg-gray-50/50 border border-gray-200 rounded-xl overflow-hidden shadow-sm focus-within:shadow-md focus-within:ring-2 focus-within:ring-[#2E4239]/20 focus-within:border-[#2E4239] transition-all group">
                                <div class="px-4 py-3.5 bg-gray-100 border-r border-gray-200 text-gray-500 font-bold text-sm group-focus-within:bg-[#2E4239] group-focus-within:text-white group-focus-within:border-[#2E4239] transition-all">
                                    Rp
                                </div>
                                <input type="number" name="harga_paket" value="{{ old('harga_paket', $paket->harga_paket) }}"
                                    class="w-full px-4 py-3.5 bg-transparent border-none focus:ring-0 text-gray-800 placeholder-gray-400"
                                    placeholder="0" min="0" required>
                            </div>
                        </div>
                    </div>

                    <!-- Row 2: Deskripsi -->
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700">Deskripsi Menu <span class="text-red-500">*</span></label>
                        <textarea name="deeskripsi_menu" rows="4"
                            class="w-full px-4 py-3.5 bg-gray-50/50 border border-gray-200 rounded-xl text-gray-800 shadow-sm focus:shadow-md focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#2E4239]/20 focus:border-[#2E4239] transition-all resize-none placeholder-gray-400"
                            placeholder="Jelaskan apa saja isi paket ini..." required>{{ old('deeskripsi_menu', $paket->deeskripsi_menu) }}</textarea>
                         <p class="text-xs text-gray-400 flex items-center gap-1">
                            <i class="fas fa-info-circle"></i>
                            Contoh: Nasi Goreng Special + Es Teh Manis + Pisang Goreng
                        </p>
                    </div>

                    <!-- Row 3: Pengaturan Gambar (Side by Side Layout Modern) -->
                    <div class="pt-6 border-t border-gray-100">
                        <label class="block text-base font-bold text-gray-800 mb-4">Pengaturan Gambar</label>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            
                            <!-- Kolom Kiri: Gambar Saat Ini -->
                            <div class="bg-gray-50 rounded-2xl p-4 border border-gray-200 flex flex-col h-full">
                                <div class="mb-3 text-sm font-semibold text-gray-500 flex justify-between items-center">
                                    <span>Gambar Saat Ini</span>
                                    @if($paket->image_paket)
                                        <span class="text-[10px] bg-blue-100 text-blue-700 px-2 py-0.5 rounded-full border border-blue-200 uppercase tracking-wide font-bold">Terpasang</span>
                                    @else
                                        <span class="text-[10px] bg-yellow-100 text-yellow-700 px-2 py-0.5 rounded-full border border-yellow-200 uppercase tracking-wide font-bold">Default</span>
                                    @endif
                                </div>
                                
                                <div class="flex-1 flex items-center justify-center bg-gray-200/50 rounded-xl overflow-hidden border-2 border-white shadow-sm relative group aspect-square md:aspect-auto">
                                    <img src="{{ paketImage($paket->image_paket) }}" 
                                         alt="{{ $paket->nama_paket }}" 
                                         class="w-full h-full object-cover">
                                </div>
                                <div class="mt-3 text-xs text-gray-400 text-center font-medium">
                                    {{ $paket->nama_paket }}
                                </div>
                            </div>

                            <!-- Kolom Kanan: Upload Gambar Baru (Drag & Drop UI) -->
                            <div class="flex flex-col h-full">
                                <label for="image_paket" class="flex-1 flex flex-col items-center justify-center w-full min-h-[250px] border-2 border-dashed border-[#2E4239]/30 rounded-2xl cursor-pointer bg-[#2E4239]/5 hover:bg-[#2E4239]/10 transition-all duration-300 relative overflow-hidden group">
                                    
                                    <!-- Placeholder State -->
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6 text-center z-10 transition-opacity duration-300 px-4" id="upload-placeholder">
                                        <div class="w-16 h-16 rounded-full bg-white flex items-center justify-center mb-4 shadow-sm group-hover:scale-110 group-hover:shadow-md transition-all duration-300">
                                            <i class="fas fa-cloud-upload-alt text-2xl text-[#2E4239]"></i>
                                        </div>
                                        <p class="text-sm font-bold text-[#2E4239] mb-1">Klik untuk Ganti Gambar</p>
                                        <p class="text-xs text-gray-500 mb-3">atau drag file ke sini</p>
                                        <span class="px-3 py-1 bg-white text-[10px] text-gray-400 rounded-full border border-gray-200 shadow-sm">JPG, PNG (Max. 2MB)</span>
                                    </div>

                                    <!-- Success State -->
                                    <div id="file-info" class="hidden absolute inset-0 bg-white/95 flex flex-col items-center justify-center z-20 backdrop-blur-sm p-6 text-center">
                                        <div class="w-14 h-14 rounded-full bg-green-50 flex items-center justify-center mb-3 shadow-sm animate-bounce-short border border-green-100">
                                            <i class="fas fa-check text-xl text-green-600"></i>
                                        </div>
                                        <p class="text-sm font-bold text-gray-800 break-all w-full" id="file-name">filename.jpg</p>
                                        <p class="text-xs text-green-600 mt-1 font-medium bg-green-50 px-3 py-1 rounded-full">Siap diupdate!</p>
                                        <p class="text-[10px] text-gray-400 mt-4">Klik lagi untuk mengubah</p>
                                    </div>

                                    <input id="image_paket" name="image_paket" type="file" class="hidden" accept="image/*" />
                                </label>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row justify-end gap-4 pt-4 border-t border-gray-200">
                <a href="{{ route('dashboard.paket.index') }}"
                    class="inline-flex justify-center items-center px-8 py-4 border border-gray-300 shadow-sm text-base font-medium rounded-xl text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-all w-full sm:w-auto hover:shadow-md">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </a>

                <button type="submit"
                    class="inline-flex justify-center items-center px-12 py-4 border border-transparent text-base font-bold rounded-xl text-white bg-[#2E4239] hover:bg-[#1a2a22] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#2E4239] transition-all transform hover:-translate-y-1 w-full sm:w-auto shadow-[0_10px_20px_-10px_rgba(46,66,57,0.6)] hover:shadow-[0_20px_30px_-5px_rgba(46,66,57,0.5)]">
                    <i class="fas fa-save mr-2"></i> Update Paket
                </button>
            </div>

        </form>
    </div>
</div>

<!-- Script Javascript untuk handling UI Upload -->
<script>
    const fileInput = document.getElementById('image_paket');
    const fileInfo = document.getElementById('file-info');
    const fileNameDisplay = document.getElementById('file-name');
    const uploadPlaceholder = document.getElementById('upload-placeholder');

    fileInput.addEventListener('change', function(e) {
        const fileName = e.target.files[0]?.name;
        if (fileName) {
            fileNameDisplay.textContent = fileName;
            fileInfo.classList.remove('hidden');
            uploadPlaceholder.classList.add('opacity-0');
        } else {
            fileInfo.classList.add('hidden');
            uploadPlaceholder.classList.remove('opacity-0');
        }
    });
</script>

<style>
    @keyframes bounce-short {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-5px); }
    }
    .animate-bounce-short {
        animation: bounce-short 0.5s ease-in-out 1;
    }
</style>
@endsection