@extends('layouts.dashboard')

@section('page-title', 'Edit Konfigurasi Website')

@section('dashboard-content')
<div class="p-8 bg-gray-50 min-h-screen">
    <div class="max-w-6xl mx-auto">
        
        <!-- Header Page -->
        <div class="mb-8 border-b border-gray-200 pb-6">
            <h2 class="text-3xl font-bold text-gray-800 tracking-tight">Konfigurasi Tampilan</h2>
            <p class="text-gray-500 mt-2 text-sm">Sesuaikan identitas visual dan konten promosi halaman utama.</p>
        </div>

        @if($errors->any())
            <div class="bg-red-50 border border-red-200 rounded-xl p-4 mb-8 flex items-start gap-3 shadow-sm">
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

        <form id="configForm" action="{{ route('konfigurasi.update', $konfigurasi->id_konfigurasi) }}" method="POST" enctype="multipart/form-data" class="space-y-10">
            @csrf
            @method('PUT')

            <!-- SECTION 1: IDENTITAS (LOGO) -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-6 md:p-8 border-b border-gray-50">
                    <h3 class="text-lg font-bold text-gray-800">Logo website</h3>
                    <p class="text-sm text-gray-400 mt-1">Logo utama yang akan muncul di header website.</p>
                </div>
                
                <div class="p-6 md:p-8 bg-white">
                    <div class="flex flex-col sm:flex-row gap-10 items-start">
                        <!-- Preview Circle -->
                        <div class="shrink-0 relative group">
                            <label class="block text-sm font-semibold text-gray-700 mb-4">Logo Saat Ini</label>
                            <div class="w-40 h-40 rounded-full border-4 border-gray-50 shadow-sm bg-gray-50 flex items-center justify-center overflow-hidden">
                                @if($konfigurasi->logo_web)
                                    <img src="{{ asset('storage/' . $konfigurasi->logo_web) }}" class="w-24 h-24 object-contain" alt="Logo">
                                @else
                                    <i class="fas fa-image text-3xl text-gray-300"></i>
                                @endif
                            </div>
                        </div>

                        <!-- Upload Area -->
                        <div class="flex-1 w-full">
                            <label class="block text-sm font-semibold text-gray-700 mb-4">Upload Logo Baru</label>
                            <div class="relative group">
                                <label for="logo_web" class="flex flex-col items-center justify-center w-full h-40 border-2 border-dashed border-gray-300 rounded-xl cursor-pointer bg-gray-50 hover:bg-gray-100 hover:border-[#2E4239] transition-all duration-200">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-3 group-hover:text-[#2E4239] transition-colors"></i>
                                        <p class="text-sm text-gray-500 group-hover:text-gray-700"><span class="font-semibold">Klik untuk upload</span> atau drag file</p>
                                        <p class="text-xs text-gray-400 mt-2">PNG, JPG, JPEG (Max. 2MB)</p>
                                    </div>
                                    <input id="logo_web" name="logo_web" type="file" class="hidden" accept="image/*" />
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- PEMBATAS / SEPARATOR -->
            <!-- Ini memberikan garis dan jarak antar section -->
            <div class="relative py-2">
                <div class="absolute inset-0 flex items-center" aria-hidden="true">
                    <div class="w-full border-t-2 border-gray-200"></div>
                </div>
            </div>

            <!-- SECTION 2: PROMOSI (CARDS) -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                
                <!-- Card 1 -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 flex flex-col h-full">
                    <div class="p-6 border-b border-gray-50 bg-gray-50/30 flex justify-between items-center">
                        <h3 class="font-bold text-gray-800">Cart 1</h3>
                        <div class="h-2 w-2 rounded-full bg-green-500"></div>
                    </div>
                    
                    <div class="p-6 flex-1 flex flex-col">
                        <!-- Label Gambar -->
                        <label class="block text-sm font-semibold text-gray-700 mb-4">Preview Gambar</label>
                        
                        <!-- Image Preview Area -->
                        <div class="relative w-full aspect-video bg-gray-100 rounded-xl overflow-hidden border border-gray-200 group mb-6">
                            @if($konfigurasi->img_card1)
                                <img src="{{ asset('storage/' . $konfigurasi->img_card1) }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" alt="Card 1">
                            @else
                                <div class="flex items-center justify-center h-full text-gray-400">
                                    <span>No Image</span>
                                </div>
                            @endif
                        </div>

                        <!-- Form Inputs -->
                        <div class="space-y-5">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Judul Kartu</label>
                                <input type="text" name="nama_card1" value="{{ old('nama_card1', $konfigurasi->nama_card1) }}" 
                                    class="w-full px-4 py-3 bg-white border border-gray-300 rounded-lg text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#2E4239]/20 focus:border-[#2E4239] transition-all"
                                    placeholder="Contoh: Tropical Tango" required>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Ganti Gambar</label>
                                <label class="flex items-center justify-center w-full px-4 py-3 bg-white border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50 hover:border-gray-400 transition-all group">
                                    <i class="fas fa-camera text-gray-400 mr-2 group-hover:text-gray-600"></i>
                                    <span class="text-sm text-gray-600 font-medium group-hover:text-gray-800">Pilih File Baru</span>
                                    <input type="file" name="img_card1" class="hidden" accept="image/*">
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 flex flex-col h-full">
                    <div class="p-6 border-b border-gray-50 bg-gray-50/30 flex justify-between items-center">
                        <h3 class="font-bold text-gray-800">Cart 2</h3>
                        <div class="h-2 w-2 rounded-full bg-blue-500"></div>
                    </div>
                    
                    <div class="p-6 flex-1 flex flex-col">
                        <!-- Label Gambar -->
                        <label class="block text-sm font-semibold text-gray-700 mb-4">Preview Gambar</label>

                        <!-- Image Preview Area -->
                        <div class="relative w-full aspect-video bg-gray-100 rounded-xl overflow-hidden border border-gray-200 group mb-6">
                            @if($konfigurasi->img_card2)
                                <img src="{{ asset('storage/' . $konfigurasi->img_card2) }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" alt="Card 2">
                            @else
                                <div class="flex items-center justify-center h-full text-gray-400">
                                    <span>No Image</span>
                                </div>
                            @endif
                        </div>

                        <!-- Form Inputs -->
                        <div class="space-y-5">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Judul Kartu</label>
                                <input type="text" name="nama_card2" value="{{ old('nama_card2', $konfigurasi->nama_card2) }}" 
                                    class="w-full px-4 py-3 bg-white border border-gray-300 rounded-lg text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#2E4239]/20 focus:border-[#2E4239] transition-all"
                                    placeholder="Contoh: Bold Baileys" required>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Ganti Gambar</label>
                                <label class="flex items-center justify-center w-full px-4 py-3 bg-white border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50 hover:border-gray-400 transition-all group">
                                    <i class="fas fa-camera text-gray-400 mr-2 group-hover:text-gray-600"></i>
                                    <span class="text-sm text-gray-600 font-medium group-hover:text-gray-800">Pilih File Baru</span>
                                    <input type="file" name="img_card2" class="hidden" accept="image/*">
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Tombol Aksi - Posisi di Bawah Halaman -->
            <div class="flex flex-col sm:flex-row justify-end gap-4 pt-6 border-t border-gray-200">
                <a href="{{ route('dashboard') }}" 
                   class="inline-flex justify-center items-center px-8 py-3 border border-gray-300 shadow-sm text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors w-full sm:w-auto">
                    Batal
                </a>
                <button type="submit" 
                        class="inline-flex justify-center items-center px-8 py-3 border border-transparent shadow-md text-sm font-bold rounded-lg text-white bg-[#2E4239] hover:bg-[#1a2a22] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#2E4239] transition-all transform hover:-translate-y-0.5 w-full sm:w-auto">
                    <i class="fas fa-save mr-2"></i> Simpan Perubahan
                </button>
            </div>

        </form>
    </div>
</div>

<!-- Script untuk preview gambar saat dipilih -->
<script>
    document.querySelectorAll('input[type="file"]').forEach(input => {
        input.addEventListener('change', function(e) {
            const fileName = e.target.files[0]?.name;
            const labelSpan = this.parentElement.querySelector('span');
            // Hanya update jika ada file yang dipilih
            if (fileName && labelSpan) {
                labelSpan.innerHTML = `<span class="text-[#2E4239] font-bold">File Terpilih:</span> ${fileName}`;
            }
        });
    });
</script>
@endsection