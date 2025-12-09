@extends('layouts.dashboard')

@section('page-title', 'Tambah Paket Baru')

@section('dashboard-content')
<div class="p-6">
    
    <!-- HEADER NAVIGASI -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Tambah Paket Menu</h2>
            <p class="text-sm text-gray-500">Buat paket makanan baru untuk pelanggan.</p>
        </div>
        <a href="{{ route('dashboard.paket.index') }}" 
           class="inline-flex items-center gap-2 text-gray-600 hover:text-[#1A2E25] bg-white border border-gray-300 hover:border-[#1A2E25] px-4 py-2 rounded-xl transition duration-200 text-sm font-medium shadow-sm">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <!-- ERROR MESSAGES -->
    @if($errors->any())
        <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-r-xl mb-6 shadow-sm">
            <div class="flex">
                <div class="flex-shrink-0">
                    <i class="fas fa-exclamation-circle text-red-500"></i>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-red-800">Terdapat kesalahan pada inputan:</h3>
                    <ul class="mt-1 list-disc list-inside text-sm text-red-700">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    <!-- FORM INPUT -->
    <form action="{{ route('dashboard.paket.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
            
            <!-- KOLOM KIRI: INPUT DATA -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-bold text-[#1A2E25] mb-4 border-b border-gray-100 pb-3">Informasi Paket</h3>
                    
                    <div class="space-y-5">
                        
                        <!-- Nama Paket -->
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Nama Paket <span class="text-red-500">*</span></label>
                            <input type="text" name="nama_paket" value="{{ old('nama_paket') }}" 
                                   class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#1A2E25] focus:border-transparent transition text-gray-900 placeholder-gray-400"
                                   placeholder="Contoh: Paket Hemat 1" required>
                        </div>

                        <!-- Harga Paket -->
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Harga Paket (Rp) <span class="text-red-500">*</span></label>
                            <div class="flex items-center w-full bg-gray-50 border border-gray-200 rounded-xl focus-within:ring-2 focus-within:ring-[#1A2E25] focus-within:border-transparent transition overflow-hidden">
                                <div class="pl-4 pr-2 text-gray-500 font-bold select-none bg-gray-50 h-full flex items-center">
                                    Rp
                                </div>
                                <input type="number" name="harga_paket" value="{{ old('harga_paket') }}" 
                                       class="flex-1 w-full py-3 px-2 bg-transparent border-none focus:ring-0 text-gray-900 placeholder-gray-400 h-full focus:outline-none"
                                       placeholder="0" min="0" required>
                            </div>
                        </div>

                        <!-- Deskripsi Menu -->
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Deskripsi Isi Menu <span class="text-red-500">*</span></label>
                            <!-- Note: Typo 'deeskripsi_menu' dipertahankan sesuai kode asli user -->
                            <textarea name="deeskripsi_menu" rows="5"
                                      class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#1A2E25] focus:border-transparent transition text-gray-900 placeholder-gray-400"
                                      placeholder="Jelaskan apa saja isi paket ini..." required>{{ old('deeskripsi_menu') }}</textarea>
                            <p class="text-xs text-gray-500 mt-2 flex items-center gap-1">
                                <i class="fas fa-info-circle"></i>
                                Contoh: Nasi Goreng Special + Es Teh Manis + Pisang Goreng
                            </p>
                        </div>

                    </div>
                </div>
            </div>

            <!-- KOLOM KANAN: UPLOAD GAMBAR & ACTION -->
            <div class="lg:col-span-1 space-y-6">
                
                <!-- Card Upload Gambar -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-bold text-[#1A2E25] mb-4">Gambar Paket</h3>
                    
                    <!-- Preview Area -->
                    <!-- aspect-square membuat kotak selalu persegi -->
                    <div class="relative w-full aspect-square bg-gray-50 border-2 border-dashed border-gray-300 rounded-xl flex flex-col items-center justify-center overflow-hidden cursor-pointer hover:border-[#1A2E25] transition group" id="uploadArea">
                        
                        <!-- Placeholder -->
                        <div id="placeholder" class="text-center p-4 transition-opacity duration-300">
                            <div class="w-16 h-16 bg-green-100 text-[#1A2E25] rounded-full flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition">
                                <i class="fas fa-cloud-upload-alt text-2xl"></i>
                            </div>
                            <p class="text-sm font-bold text-gray-700">Upload Foto</p>
                            <p class="text-xs text-gray-400 mt-1">Klik disini</p>
                        </div>

                        <!-- Image Preview -->
                        <!-- PERUBAHAN: object-cover diganti object-contain agar gambar full/tidak terpotong -->
                        <img id="imagePreview" src="" class="absolute inset-0 w-full h-full object-contain hidden p-2">

                        <!-- Input File Hidden -->
                        <input type="file" name="image_paket" id="imageInput" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" accept="image/*" required>
                    </div>
                    
                    <p class="text-xs text-center text-gray-400 mt-3">
                        Rekomendasi: Gunakan gambar dengan rasio 1:1 (Persegi).
                    </p>
                </div>

                <!-- Tombol Simpan -->
                <button type="submit" class="w-full bg-[#1A2E25] hover:bg-[#14241d] text-white font-bold py-4 rounded-xl shadow-lg shadow-green-900/10 transition transform hover:-translate-y-1 flex items-center justify-center gap-2">
                    <i class="fas fa-save"></i>
                    Simpan Paket Baru
                </button>

            </div>

        </div>
    </form>
</div>

<!-- SCRIPT PREVIEW GAMBAR -->
<script>
    const uploadArea = document.getElementById('uploadArea');
    const imageInput = document.getElementById('imageInput');
    const imagePreview = document.getElementById('imagePreview');
    const placeholder = document.getElementById('placeholder');

    imageInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
                imagePreview.classList.remove('hidden');
                placeholder.classList.add('opacity-0'); // Sembunyikan placeholder
            }
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection