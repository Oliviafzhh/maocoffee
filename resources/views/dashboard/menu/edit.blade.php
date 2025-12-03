@extends('layouts.dashboard')

@section('page-title', 'Edit Menu')

@section('dashboard-content')
<div class="p-8 bg-gray-50 min-h-screen">
    <div class="max-w-4xl mx-auto">
        
        <!-- Header Page -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8 border-b border-gray-200 pb-6">
            <div>
                <h2 class="text-3xl font-bold text-gray-800 tracking-tight">Edit Menu</h2>
                <p class="text-gray-500 mt-2 text-sm">Perbarui informasi menu yang sudah ada.</p>
            </div>
        </div>

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

        <form id="menuForm" action="{{ route('dashboard.menu.update', $menu->id_menu) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf
            @method('PUT')

            <!-- Card Utama -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="p-6 md:p-8 border-b border-gray-50 bg-gray-50/30 flex items-center justify-between">
                    <h3 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                        Informasi Menu
                    </h3>
                    <span class="text-xs text-gray-400 font-medium">* Wajib diisi</span>
                </div>

                <div class="p-6 md:p-8 space-y-8">
                    
                    <!-- Row 1: Nama Menu & Kategori -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Nama Menu -->
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-gray-700">Nama Menu <span class="text-red-500">*</span></label>
                            <input type="text" name="nama_menu" value="{{ old('nama_menu', $menu->nama_menu) }}" 
                                class="w-full px-4 py-3.5 bg-gray-50/50 border border-gray-200 rounded-xl text-gray-800 shadow-sm focus:shadow-md focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#2E4239]/20 focus:border-[#2E4239] transition-all placeholder-gray-400"
                                placeholder="Contoh: Nasi Goreng Spesial" required>
                        </div>

                        <!-- Kategori -->
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-gray-700">Kategori <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <select name="kategori" 
                                    class="w-full px-4 py-3.5 bg-gray-50/50 border border-gray-200 rounded-xl text-gray-800 shadow-sm focus:shadow-md focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#2E4239]/20 focus:border-[#2E4239] transition-all appearance-none cursor-pointer" required>
                                    <option value="Food" {{ old('kategori', $menu->kategori) == 'Food' ? 'selected' : '' }}>Makanan (Food)</option>
                                    <option value="Drink" {{ old('kategori', $menu->kategori) == 'Drink' ? 'selected' : '' }}>Minuman (Drink)</option>
                                    <option value="Snack" {{ old('kategori', $menu->kategori) == 'Snack' ? 'selected' : '' }}>Cemilan (Snack)</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-gray-500">
                                    <i class="fas fa-chevron-down text-xs"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Row 2: Harga & Stok -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Harga (Diperbaiki agar Rp tidak menutupi input) -->
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-gray-700">Harga <span class="text-red-500">*</span></label>
                            <!-- Menggunakan flex container agar "Rp" dan Input berdampingan rapi -->
                            <div class="flex items-center bg-gray-50/50 border border-gray-200 rounded-xl overflow-hidden shadow-sm focus-within:shadow-md focus-within:ring-2 focus-within:ring-[#2E4239]/20 focus-within:border-[#2E4239] transition-all group">
                                <div class="px-4 py-3.5 bg-gray-100 border-r border-gray-200 text-gray-500 font-bold text-sm group-focus-within:bg-[#2E4239] group-focus-within:text-white group-focus-within:border-[#2E4239] transition-all">
                                    Rp
                                </div>
                                <input type="number" name="harga" value="{{ old('harga', $menu->harga) }}" 
                                    class="w-full px-4 py-3.5 bg-transparent border-none focus:ring-0 text-gray-800 placeholder-gray-400"
                                    placeholder="0" min="0" required>
                            </div>
                        </div>

                        <!-- Stok -->
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-gray-700">Stok <span class="text-red-500">*</span></label>
                            <input type="number" name="stok" value="{{ old('stok', $menu->stok) }}" 
                                class="w-full px-4 py-3.5 bg-gray-50/50 border border-gray-200 rounded-xl text-gray-800 shadow-sm focus:shadow-md focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#2E4239]/20 focus:border-[#2E4239] transition-all"
                                placeholder="0" min="0" required>
                        </div>
                    </div>

                    <!-- Row 3: Deskripsi -->
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700">Deskripsi Menu <span class="text-red-500">*</span></label>
                        <textarea name="deskripsi_menu" rows="4"
                            class="w-full px-4 py-3.5 bg-gray-50/50 border border-gray-200 rounded-xl text-gray-800 shadow-sm focus:shadow-md focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#2E4239]/20 focus:border-[#2E4239] transition-all resize-none placeholder-gray-400"
                            placeholder="Jelaskan detail rasa, bahan utama, atau keunikan menu ini..." required>{{ old('deskripsi_menu', $menu->deskripsi_menu) }}</textarea>
                    </div>

                    <!-- Row 4: Gambar (Stacked Layout - Atas Bawah) -->
                    <div class="space-y-8 pt-4 border-t border-gray-100">
                        <!-- 1. Preview Gambar Lama (Besar) -->
                        <div class="space-y-3">
                            <label class="block text-base font-bold text-gray-800 flex items-center gap-2">
                                <i class="fas fa-image text-[#2E4239]"></i> Gambar Saat Ini
                            </label>
                            <!-- Container Besar -->
                            <div class="w-full h-96 bg-gray-50 border-2 border-gray-200 rounded-2xl flex items-center justify-center overflow-hidden p-4 shadow-sm relative group">
                                <img src="{{ asset('storage/' . $menu->img_menu) }}" alt="Current Image" class="w-full h-full object-contain rounded-lg transition-transform duration-500 group-hover:scale-105">
                                <div class="absolute inset-0 bg-black/5 rounded-2xl pointer-events-none border border-black/5"></div>
                            </div>
                        </div>

                        <!-- 2. Area Upload Gambar Baru (Di Bawahnya) -->
                        <div class="space-y-3">
                            <label class="block text-base font-bold text-gray-800 flex items-center gap-2">
                                <i class="fas fa-cloud-upload-alt text-[#2E4239]"></i> Ganti Gambar (Opsional)
                            </label>
                            
                            <div class="relative group">
                                <!-- Area Upload -->
                                <label for="img_menu" class="flex flex-col items-center justify-center w-full h-48 border-2 border-dashed border-[#2E4239]/30 rounded-2xl cursor-pointer bg-[#2E4239]/5 hover:bg-[#2E4239]/10 transition-all duration-300 relative overflow-hidden group-hover:border-[#2E4239]/60">
                                    
                                    <!-- Placeholder Content -->
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6 text-center z-10 transition-opacity duration-300" id="upload-placeholder">
                                        <div class="w-16 h-16 rounded-full bg-white flex items-center justify-center mb-3 shadow-md group-hover:scale-110 transition-transform duration-300">
                                            <i class="fas fa-camera text-3xl text-[#2E4239]"></i>
                                        </div>
                                        <p class="text-base text-[#2E4239] font-bold mb-1">Klik untuk ganti foto baru</p>
                                        <p class="text-sm text-gray-500">atau drag file ke area ini</p>
                                        <span class="mt-3 px-3 py-1 bg-white text-xs text-gray-500 rounded-full border border-gray-200 font-medium">JPG, PNG, GIF (Max. 2MB)</span>
                                    </div>

                                    <!-- File Info Overlay (Hidden by Default) -->
                                    <div id="file-info" class="hidden absolute inset-0 bg-white/95 flex flex-col items-center justify-center z-20 backdrop-blur-sm">
                                        <div class="w-16 h-16 rounded-full bg-green-50 flex items-center justify-center mb-3 shadow-md animate-bounce-short border border-green-100">
                                            <i class="fas fa-check text-3xl text-green-600"></i>
                                        </div>
                                        <p class="text-base font-bold text-gray-800 mb-1 px-4 text-center break-all" id="file-name">filename.jpg</p>
                                        <p class="text-xs text-gray-500 bg-gray-100 px-3 py-1.5 rounded-full mt-2">Klik area untuk mengganti lagi</p>
                                    </div>

                                    <!-- Input File Asli (Hidden) -->
                                    <input id="img_menu" name="img_menu" type="file" class="hidden" accept="image/*" />
                                </label>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Action Buttons (Besar dan Mantap) -->
            <div class="flex flex-col sm:flex-row justify-end gap-4 pt-4 border-t border-gray-200">
                <!-- Tombol Kembali -->
                <a href="{{ route('dashboard.menu.index') }}" 
                   class="inline-flex justify-center items-center px-8 py-4 border border-gray-300 shadow-sm text-base font-medium rounded-xl text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-all w-full sm:w-auto hover:shadow-md">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </a>
                
                <!-- TOMBOL UPDATE: Diperbesar & Bayangan Mewah -->
                <button type="submit" 
                        class="inline-flex justify-center items-center px-12 py-4 border border-transparent text-base font-bold rounded-xl text-white bg-[#2E4239] hover:bg-[#1a2a22] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#2E4239] transition-all transform hover:-translate-y-1 w-full sm:w-auto shadow-[0_10px_20px_-10px_rgba(46,66,57,0.6)] hover:shadow-[0_20px_30px_-5px_rgba(46,66,57,0.5)]">
                    <i class="fas fa-save mr-2"></i> Update Menu
                </button>
            </div>

        </form>
    </div>
</div>

<!-- Script Sederhana untuk Menampilkan Nama File saat Dipilih -->
<script>
    const fileInput = document.getElementById('img_menu');
    const fileInfo = document.getElementById('file-info');
    const fileNameDisplay = document.getElementById('file-name');
    const uploadPlaceholder = document.getElementById('upload-placeholder');

    fileInput.addEventListener('change', function(e) {
        const fileName = e.target.files[0]?.name;
        if (fileName) {
            fileNameDisplay.textContent = fileName;
            fileInfo.classList.remove('hidden');
            uploadPlaceholder.classList.add('opacity-0'); // Hide placeholder smoothly
        } else {
            fileInfo.classList.add('hidden');
            uploadPlaceholder.classList.remove('opacity-0');
        }
    });
</script>

<style>
    @keyframes bounce-short {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }
    .animate-bounce-short {
        animation: bounce-short 0.5s ease-in-out 1;
    }
</style>
@endsection